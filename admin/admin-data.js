/* ACONOQ - source unique du dashboard : Supabase */
(async function () {
  const url = window.SUPABASE_URL || 'https://lzwqgymlbbzyhbfshrpu.supabase.co';
  const anonKey = window.SUPABASE_ANON_KEY || 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imx6d3FneW1sYmJ6eWhiZnNocnB1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODU5Nzk2MzMsImV4cCI6MjEwMTU1NTYzM30.qYp6V_KdLkjjUQQxW48Z5RXRYnLJavXEkek5rqL1iCg';

  // Try to get a fresh token from Supabase client session (handles refresh automatically)
  async function getToken() {
    try {
      // supabaseClient is declared with const in supabase.js — accessible in global scope
      if (typeof supabaseClient !== 'undefined' && supabaseClient.auth) {
        const { data: { session } } = await supabaseClient.auth.getSession();
        if (session && session.access_token) return session.access_token;
      }
    } catch (e) { /* ignore, will use fallback */ }
    // Fallback to stored token, then anon key
    return sessionStorage.getItem('aconoq_access_token') || anonKey;
  }

  async function getHeaders() {
    const token = await getToken();
    return { apikey: anonKey, Authorization: 'Bearer ' + token, 'Content-Type': 'application/json' };
  }

  async function query(table, params) {
    if (!params) params = 'select=*';
    const h = await getHeaders();
    const r = await fetch(url + '/rest/v1/' + table + '?' + params, { headers: h });
    if (!r.ok) throw new Error(await r.text());
    return r.json();
  }

  async function mutate(table, method, body, id) {
    const h = await getHeaders();
    const r = await fetch(url + '/rest/v1/' + table + (id ? '?id=eq.' + encodeURIComponent(id) : ''), {
      method,
      headers: { ...h, Prefer: 'return=representation' },
      body: JSON.stringify(body)
    });
    if (!r.ok) throw new Error(await r.text());
    return r.status === 204 ? [] : r.json();
  }

  window.AconoqData = {
    query,
    insert: (t, b) => mutate(t, 'POST', b),
    update: (t, id, b) => mutate(t, 'PATCH', b, id),
    remove: (t, id) => mutate(t, 'DELETE', null, id)
  };

  window.AconoqData.dashboard = async () => {
    const [news, events, normes, messages, heroes, sections] = await Promise.all([
      query('actualites', 'select=*&order=created_at.desc'),
      query('evenements', 'select=*&order=created_at.desc'),
      query('normes', 'select=*&order=created_at.desc'),
      query('contact_messages', 'select=*&order=created_at.desc'),
      query('page_heroes', 'select=*'),
      query('page_sections', 'select=*')
    ]);
    return { news, events, normes, messages, heroes, sections };
  };
})();

const s = window.supabaseClient || window.supabase;
const c = s.createClient('https://lzwqgymlbbzyhbfshrpu.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imx6d3FneW1sYmJ6eWhiZnNocnB1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODU5Nzk2MzMsImV4cCI6MjEwMTU1NTYzM30.qYp6V_KdLkjjUQQxW48Z5RXRYnLJavXEkek5rqL1iCg');
const urls = [
  { nom: 'COTECNA', u: 'https://cdn.brandfetch.io/id11m9B62s/w/400/h/400/theme/dark/icon.jpeg?c=1bxid64Mup7aczewSAYMX' },
  { nom: 'TÜV', u: 'https://logowik.com/content/uploads/images/tuv-sud7852.logowik.com.webp' },
  { nom: 'Bureau Veritas', u: 'https://companieslogo.com/img/orig/BVI.PA_BIG-ce76bf51.png' },
  { nom: 'ARSO', u: 'https://latestlogo.com/wp-content/uploads/2024/08/arso.png' }
];
for (const l of urls) {
  const { error } = await c.from('partenaires').update({ logo_url: l.u }).eq('nom', l.nom);
  console.log(l.nom, error ? error : 'OK');
}
console.log('DONE - refresh page');

// ============================================
// ACONOQ - Configuration Supabase
// Falls back to hardcoded values if PHP didn't inject them
// ============================================
if (typeof SUPABASE_URL === 'undefined') var SUPABASE_URL = 'https://lzwqgymlbbzyhbfshrpu.supabase.co';
if (typeof SUPABASE_ANON_KEY === 'undefined') var SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imx6d3FneW1sYmJ6eWhiZnNocnB1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODU5Nzk2MzMsImV4cCI6MjEwMTU1NTYzM30.qYp6V_KdLkjjUQQxW48Z5RXRYnLJavXEkek5rqL1iCg';

const supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

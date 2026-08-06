-- ============================================
-- ACONOQ - Migration: Dynamic Content Tables
-- Run this in Supabase Dashboard > SQL Editor
-- ============================================

-- 1. SITE SETTINGS (contact, social, footer, etc.)
CREATE TABLE IF NOT EXISTS site_settings (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  key text UNIQUE NOT NULL,
  value jsonb NOT NULL,
  updated_at timestamptz DEFAULT now()
);

-- 2. PAGE HEROES (hero banner per page)
CREATE TABLE IF NOT EXISTS page_heroes (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text UNIQUE NOT NULL,
  image_url text,
  title text NOT NULL,
  subtitle text,
  updated_at timestamptz DEFAULT now()
);

-- 3. HERO SLIDES (homepage carousel)
CREATE TABLE IF NOT EXISTS hero_slides (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  image_url text NOT NULL,
  alt_text text DEFAULT '',
  badge text,
  title text,
  subtitle text,
  cta1_label text,
  cta1_url text,
  cta2_label text,
  cta2_url text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 4. SERVICES (homepage service cards)
CREATE TABLE IF NOT EXISTS services (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  title text NOT NULL,
  description text,
  icon_class text,
  link_url text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 5. BANNERS (full-width promo sections)
CREATE TABLE IF NOT EXISTS banners (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  image_url text,
  badge text,
  title text,
  highlight_text text,
  description text,
  cta1_label text,
  cta1_url text,
  cta2_label text,
  cta2_url text,
  features jsonb DEFAULT '[]'::jsonb,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 6. PROCESSUS (process carousel cards)
CREATE TABLE IF NOT EXISTS processus (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  title text NOT NULL,
  description text,
  icon_class text,
  link_url text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 7. PAGE SECTIONS (generic content blocks for any page)
-- Covers: text blocks, checklists, definitions, introductions
CREATE TABLE IF NOT EXISTS page_sections (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  section_key text NOT NULL,
  badge text,
  title text,
  icon_class text,
  content jsonb NOT NULL DEFAULT '{}'::jsonb,
  -- content can hold: { paragraphs: [...], items: [...], highlight: "...", image_url: "..." }
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now(),
  UNIQUE(page_slug, section_key)
);

-- 8. CARD GRIDS (reusable card collections)
-- Covers: typologies, principles, roles, missions, activities, enjeux, etc.
CREATE TABLE IF NOT EXISTS card_grids (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  grid_key text NOT NULL,
  title text,
  badge text,
  card_title text NOT NULL,
  card_description text,
  card_icon text,
  card_color text,
  card_number text,
  card_link text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 9. FAQ ITEMS
CREATE TABLE IF NOT EXISTS faq_items (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  question text NOT NULL,
  answer text NOT NULL,
  icon_class text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 10. CERTIFICATION STEPS (conformite process timeline)
CREATE TABLE IF NOT EXISTS certification_steps (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  step_number int NOT NULL,
  title text NOT NULL,
  description text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 11. PCEC EXCEPTIONS (products list)
CREATE TABLE IF NOT EXISTS pcec_exceptions (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  title text NOT NULL,
  intro_text text,
  items jsonb NOT NULL DEFAULT '[]'::jsonb,
  updated_at timestamptz DEFAULT now()
);

-- 12. CONTACT INFO (structured contact details)
CREATE TABLE IF NOT EXISTS contact_info (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  info_type text NOT NULL,
  icon_class text,
  title text,
  value text,
  link text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 13. SCHEDULE (opening hours)
CREATE TABLE IF NOT EXISTS schedule (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  days text NOT NULL,
  hours text NOT NULL,
  status text DEFAULT 'Ouvert',
  ordre int DEFAULT 0,
  updated_at timestamptz DEFAULT now()
);

-- 14. ADVANTAGES (boutique advantages)
CREATE TABLE IF NOT EXISTS advantages (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  icon_class text,
  title text NOT NULL,
  description text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- 15. HOW IT WORKS (step-by-step guides)
CREATE TABLE IF NOT EXISTS how_it_works (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  page_slug text NOT NULL,
  step_number int NOT NULL,
  title text NOT NULL,
  description text,
  icon_class text,
  ordre int DEFAULT 0,
  active boolean DEFAULT true,
  updated_at timestamptz DEFAULT now()
);

-- ============================================
-- INDEXES
-- ============================================
CREATE INDEX IF NOT EXISTS idx_page_heroes_slug ON page_heroes(page_slug);
CREATE INDEX IF NOT EXISTS idx_page_sections_slug ON page_sections(page_slug, section_key);
CREATE INDEX IF NOT EXISTS idx_card_grids_slug ON card_grids(page_slug, grid_key);
CREATE INDEX IF NOT EXISTS idx_faq_items_slug ON faq_items(page_slug);
CREATE INDEX IF NOT EXISTS idx_banners_slug ON banners(page_slug);
CREATE INDEX IF NOT EXISTS idx_advantages_slug ON advantages(page_slug);
CREATE INDEX IF NOT EXISTS idx_how_it_works_slug ON how_it_works(page_slug);

-- ============================================
-- RLS (Row Level Security) - anon read, service_role write
-- ============================================
ALTER TABLE site_settings ENABLE ROW LEVEL SECURITY;
ALTER TABLE page_heroes ENABLE ROW LEVEL SECURITY;
ALTER TABLE hero_slides ENABLE ROW LEVEL SECURITY;
ALTER TABLE services ENABLE ROW LEVEL SECURITY;
ALTER TABLE banners ENABLE ROW LEVEL SECURITY;
ALTER TABLE processus ENABLE ROW LEVEL SECURITY;
ALTER TABLE page_sections ENABLE ROW LEVEL SECURITY;
ALTER TABLE card_grids ENABLE ROW LEVEL SECURITY;
ALTER TABLE faq_items ENABLE ROW LEVEL SECURITY;
ALTER TABLE certification_steps ENABLE ROW LEVEL SECURITY;
ALTER TABLE pcec_exceptions ENABLE ROW LEVEL SECURITY;
ALTER TABLE contact_info ENABLE ROW LEVEL SECURITY;
ALTER TABLE schedule ENABLE ROW LEVEL SECURITY;
ALTER TABLE advantages ENABLE ROW LEVEL SECURITY;
ALTER TABLE how_it_works ENABLE ROW LEVEL SECURITY;

-- Allow public read access
CREATE POLICY "Public read" ON site_settings FOR SELECT USING (true);
CREATE POLICY "Public read" ON page_heroes FOR SELECT USING (true);
CREATE POLICY "Public read" ON hero_slides FOR SELECT USING (true);
CREATE POLICY "Public read" ON services FOR SELECT USING (true);
CREATE POLICY "Public read" ON banners FOR SELECT USING (true);
CREATE POLICY "Public read" ON processus FOR SELECT USING (true);
CREATE POLICY "Public read" ON page_sections FOR SELECT USING (true);
CREATE POLICY "Public read" ON card_grids FOR SELECT USING (true);
CREATE POLICY "Public read" ON faq_items FOR SELECT USING (true);
CREATE POLICY "Public read" ON certification_steps FOR SELECT USING (true);
CREATE POLICY "Public read" ON pcec_exceptions FOR SELECT USING (true);
CREATE POLICY "Public read" ON contact_info FOR SELECT USING (true);
CREATE POLICY "Public read" ON schedule FOR SELECT USING (true);
CREATE POLICY "Public read" ON advantages FOR SELECT USING (true);
CREATE POLICY "Public read" ON how_it_works FOR SELECT USING (true);
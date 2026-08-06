-- Exécuter dans le SQL Editor de Supabase Dashboard
-- Ajout des colonnes type_iso et origine à la table normes

ALTER TABLE normes ADD COLUMN IF NOT EXISTS type_iso TEXT DEFAULT 'NCGO';
ALTER TABLE normes ADD COLUMN IF NOT EXISTS origine TEXT DEFAULT 'Congolais';

-- Mise à jour des données existantes
UPDATE normes SET type_iso = 'ISO 9001', origine = 'International' WHERE code = 'NCGO 001-2024';
UPDATE normes SET type_iso = 'HACCP', origine = 'International' WHERE code = 'NCGO 002-2024';
UPDATE normes SET type_iso = 'NCGO', origine = 'Congolais' WHERE code = 'NCGO 003-2024';
UPDATE normes SET type_iso = 'NCGO', origine = 'Congolais' WHERE code = 'NCGO 004-2024';
UPDATE normes SET type_iso = 'IEC', origine = 'International' WHERE code = 'NCGO 005-2024';
UPDATE normes SET type_iso = 'NCGO', origine = 'Congolais' WHERE code = 'NCGO 006-2024';

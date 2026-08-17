-- Renommer PCEC en DEC dans la table directions
UPDATE directions
SET nom = REPLACE(nom, 'PCEC', 'DEC')
WHERE nom LIKE '%PCEC%';

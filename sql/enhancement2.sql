-- 1
INSERT INTO clients(	
    clientFirstname
    ,clientLastname
    ,clientEmail
    ,clientPassword
    ,comment
)
VALUES (
    'Tony'
    , 'Stark'
    , 'tony@starkent.com'
    , 'Iam1ronM@n'
    , 'I am the real Ironman'
);
-- 2
UPDATE clients
SET clientLevel = "3"
WHERE clientEmail = "tony@starkent.com";

--3
UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12;

--4
SELECT   i.invModel
        ,c.classificationName
FROM    inventory i 
INNER JOIN carclassification c
ON      i.classificationId = c.classificationId
WHERE   c.classificationName = "SUV";

--5 
DELETE  FROM inventory
WHERE invMake = "Jeep" AND invModel = "Wrangler";

--6
UPDATE inventory
SET invImage = CONCAT("/phpmotors",invImage)
    ,invThumbnail = CONCAT("/phpmotors",invThumbnail);





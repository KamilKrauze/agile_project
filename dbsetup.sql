-- Queries for creating/populating the tables; 
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Recipes;
CREATE TABLE Recipes (
  RecipeID    int(6) NOT NULL AUTO_INCREMENT, 
  RecipeName  varchar(100) NOT NULL, 
  ShortDesc   varchar(255), 
  PrepTime    int(4), 
  CookTime    int(4), 
  TotalTime   int(4), 
  Servings    tinyint(2),
  Instructions  varchar(2500),
  Views     int,
  PRIMARY KEY (RecipeID));

DROP TABLE IF EXISTS Ingredients;
CREATE TABLE Ingredients (
  IngredientID    int(6) NOT NULL AUTO_INCREMENT, 
  IngredientName  varchar(100) NOT NULL, 
  AllergenID      int(3) NOT NULL, 
  ShopLink        varchar(255), 
  isSpice     bit,
  PRIMARY KEY (IngredientID));
  
  
DROP TABLE IF EXISTS Allergens;
CREATE TABLE Allergens (
  AllergenID        int(3) NOT NULL AUTO_INCREMENT, 
  AllergenName    varchar(100) NOT NULL, 
  ShortDesc       varchar(255), 
  PRIMARY KEY (AllergenID));

DROP TABLE IF EXISTS RecipeIngredients;
CREATE TABLE RecipeIngredients (
  RecipeID    int(6) NOT NULL, 
  IngredientID  int(6) NOT NULL, 
  Quantity    double(4,1) NOT NULL,
  MeasurementID int(2) NOT NULL,
  PRIMARY KEY (RecipeID, IngredientID));

DROP TABLE IF EXISTS Measurements;
CREATE TABLE Measurements (
  MeasurementID int(2) NOT NULL AUTO_INCREMENT,
  MeasurementType varchar(64) NOT NULL,
  PRIMARY KEY (MeasurementID));


ALTER TABLE Ingredients ADD CONSTRAINT AllergenKey FOREIGN KEY (AllergenID) REFERENCES Allergens (AllergenID);

ALTER TABLE RecipeIngredients ADD CONSTRAINT RecipeKey FOREIGN KEY (RecipeID) REFERENCES Recipes (RecipeID);
ALTER TABLE RecipeIngredients ADD CONSTRAINT IngredientKey FOREIGN KEY (IngredientID) REFERENCES Ingredients (IngredientID);
ALTER TABLE RecipeIngredients ADD CONSTRAINT MeasurementKey FOREIGN KEY (MeasurementID) REFERENCES Measurements (MeasurementID);


SET FOREIGN_KEY_CHECKS=1;

INSERT INTO Allergens(AllergenName) VALUES
('None'),('Nuts'),('Sesame'),('Soya'),('Legumes'),('Celery'),('Gluten'),('Sugar'),('Citrus'),('Milk'),('Eggs');


INSERT INTO Measurements(MeasurementType) VALUES
(''),('g'),('kg'),('ml'),('l'),('oz'),('tbsp'),('tsp'),('cup(s)'),('glass(es)'),('can(s)'),('bunch'),('clove(s)'),('roll(s)'),('stick(s)'),('piece(s)'),('nest(s)');

INSERT INTO Ingredients (IngredientName, AllergenID, ShopLink) VALUES
('Basmati rice',1,'https://thelittlegreenlarder.com/products/basmati-rice?_pos=1&_psq=basmati&_ss=e&_v=1.0'),
('chickpeas',5 , 'https://thelittlegreenlarder.com/products/chickpeas?_pos=1&_psq=chickpea&_ss=e&_v=1.0'),
('cannellini beans', 5,'https://thelittlegreenlarder.com/products/cannellini-beans?_pos=1&_psq=can&_ss=e&_v=1.0'),
('orzo',1, 'https://thelittlegreenlarder.com/products/orzo-rice?_pos=1&_psq=orzo&_ss=e&_v=1.0'),
('arborio rice', 1, 'https://thelittlegreenlarder.com/products/arborio-rice?_pos=1&_sid=7c1d4e790&_ss=r'),
('green lentils', 5, 'https://thelittlegreenlarder.com/products/green-lentils?_pos=1&_psq=green&_ss=e&_v=1.0'),
('noodles', 7, 'https://thelittlegreenlarder.com/products/noodles?_pos=1&_psq=nood&_ss=e&_v=1.0'),
('sugar', 8, 'https://thelittlegreenlarder.com/products/refined-white-caster-sugar?_pos=1&_psq=sugar&_ss=e&_v=1.0'),
('baking powder',1, 'https://thelittlegreenlarder.com/products/baking-powder?pr_prod_strat=collection_fallback&pr_rec_id=0ea902136&pr_rec_pid=7356987343005&pr_ref_pid=7356988194973&pr_seq=uniform'),
('chopped tomatoes',1, 'https://thelittlegreenlarder.com/products/tinned-veg-pulses?_pos=2&_psq=tomatoes&_ss=e&_v=1.0&variant=41840316514461'),
('mixed beans', 5, 'https://thelittlegreenlarder.com/products/mixed-beans?_pos=3&_psq=mixed%20be&_ss=e&_v=1.0&variant=42219676270749'),
('couscous', 7, 'https://thelittlegreenlarder.com/products/organic-white-couscous?_pos=1&_psq=cous&_ss=e&_v=1.0'),
('loaf of bread', 7, 'https://thelittlegreenlarder.com/products/loaf-of-bread-only-available-tue-thu-sat?_pos=1&_psq=cobb&_ss=e&_v=1.0&variant=37570967634077');

INSERT INTO Ingredients (IngredientName, AllergenID) VALUES
('garlic', 1),
('curry paste', 1),
('curry powder', 1),
('onion', 1),
('sweet potato', 1),
('carrot', 1),
('coconut milk', 1),
('celery', 6),
('potato', 1),
('parsley', 1),
('vegetable stock', 1),
('pepper', 1),
('tomato', 1),
('fresh ginger', 1),
('courgette', 1),
('lime', 9),
('falafel mix', 5),
('avocado', 1),
('red onion', 1),
('cherry tomatoes', 1),
('soy sauce', 4),
('mushrooms', 1),
('self-raising flour', 7),
('milk', 10),
('oil', 1),
('kibbled onions', 1);


INSERT INTO Recipes(RecipeName, Servings, Instructions) VALUES
('Sweet Potato and Chick Pea Curry', 4,  
'- Soak chickpeas for 4 – 8hours (we just leave them overnight), rinse then place in a pot of
water
- Bring to boil then simmer for 1 – 2 hours. Drain and set aside
- Peel and chop your garlic and veg
- Fry the onions and garlic in oil for 1min then add curry paste and curry powder and fry a
further 2 mins
- Add can of coconut milk, stir then add sweet potato and chick peas. cook for 10 mins
- Add carrots and cook for 10 – 15 mins until all veg is cooked through
- Bring some water to the boil in a pot, rinse rice and add to boiling water and simmer for 15
– 20 minutes until cooked
- Serve and enjoy'),
('Minestrone Soup', 5, '
- Chop all of your vegetables and strain the cannellini beans
- In a large pot fry onions and garlic until softened
- Add celery, carrots and potatoes and cook for 2 – 3 minutes
- Add cannellini beans and parsley and cover with veg stock until everything is just covered
- Add can of tomatoes and simmer for 45 mins – an hour
- Cook the orzo in a separate pot, strain and add to the soup
- Serve and enjoy'),
('Paella with Spanish Salad',4, '
Paella:
- Add the rice, spices and veg stock to a pot, simmer gently (stirring occasionally) until most
of the liquid has been absorbed. Once this happens remove from heat and leave to sit for 5
minutes.
- Finely chop one onion and garlic then fry in a pan or for 2 – 4 minutes
- Chop the pepper and tomatoes and add that to the pan, fry until cooked through.
-Add the vegetables to the paella rice and mix through
Salad:
- Cut the courgette in half lengthways then finely slice it, finely slice the red onion and half
all of the cherry tomatoes
- Combine them all in a bowl with olive oil salt and pepper
Serve and enjoy!'),
('Thai Green Lentil and Vegetable Curry', 2, '
- Peel and chop your garlic, chilli, ginger and veg
- Fry onions, chilli, ginger and garlic in oil for 2 mins. Add the curry paste and cook for
another 2 mins stirring often
- strain and add in the green lentils and coconut milk, bring to boil and simmer for 15 mins
(a little more if you did not soak lentils)
- Add vegetables and simmer for another 5 minutes until everything is tender. Remove from
heat and add a squeeze of lime to taste
- Boil noodles or rice in water, drain and serve'),
('Cajun Chick Pea Burgers with Wedges', 2, '
Burgers:
- Soak chickpeas for 4 – 8hours (we just leave them overnight), rinse then place in a pot of
water. Bring to boil then simmer for 1 -2 hour. Drain and set aside
- Grate the carrots and courgette, squeeze excess water out with a towel or napkin
- Blend/ mash chickpeas until they are coarsely mashed, but not to a paste.
- Chop the onion and 2 – 4 garlic cloves, fry with the burger spices for 2- 4 mins
- Combine all of the ingredients in a bowl, add salt and pepper to taste. Form into burgers
and fry in oil for 5 mins each side
Wedges:
- Cut potatoes into wedges and place on a baking tray. Lightly drizzle over some oil and
sprinkle on the wedge spices.
- Cook at 200/ gas mark 6 for 15 – 20 mins
- Serve and enjoy'),
('Falafel Burgers with Guac and salad', 2, '
Burgers:
- Add water 1tbsp at a time to falafel mix until it holds together, set aside for 10 mins then
shape into 2 patties
- Fry the falafel burgers in oil for a few mins each side and serve on roll
Guac:
- Mash avocado, mix with 1 – 2 garlic cloves, ½ red onion, chopped fresh tomatoes, ½ of the
chilli and squeeze ½ of the lime juice in. Salt and pepper to taste.
Salad:
- Use a veg peeler to ribbon the carrot and courgette, chop onion and half the cherry
tomatoes
- Mix the vegetables in a bowl
- Add ½ chilli if you want a bit of spice and squeeze ½ a lime over, salt and pepper to taste
Serve and enjoy'),
('Ramen Noodle Bowl', 4, '
- Soak the dried mushrooms in a bowl with 100ml water for 20 mins (retain water). Boil the
noodles in a pot of water for 5 minutes, strain and set aside
- Meanwhile peel and finely chop the garlic and grate the ginger. Finely chop your chillies
(remove the seeds for less heat).
- Slice the onions, spring onions and fresh mushrooms. Use a potato peeler to ribbon your
carrots (if you don’t have a peeler you can grate or finely slice them).
- In a large pot fry your onions, garlic, ginger and chilli in the oil for 4 minutes. Add the
carrots and fresh mushrooms to your pot and fry for 2 more minutes
- Add the stock and dried mushrooms (including the water they were soaked in as it is full of
flavour) into the pot along with the noodles
- Continue to cook until the noodles are warm then add soy sauce to taste
- Serve in a deep bowl topped with sliced spring onions ontop. '),
('Pancakes', 2, '
- Put all dry ingredients in a bowl
- Add milk and mix thoroughly
- Heat oil in a pan on a medium heat
- Add one tbsp pancake mix to pan
- Once bubbles form and burst on top of pancake flip it over
- After 40 seconds remove from heat
- Continue until all pancake mix is finished
- Serve and enjoy'),
('Chilli With Pearl Cous Cous', 4, '- Soak mixed beans and chick peas together for 4 – 8hours (we just leave them overnight)
- Rinse beans then place in a pot of water. Bring to boil then simmer for 1 hour. Drain and
set aside
- Soak TVP mince for 10 mins, drain + set aside.
- Chop all of your vegetables and garlic
- In a large pot fry 2 – 4 cloves garlic with the onion and spices in oil for 2 – 4 minutes. (add
the chilli for extra spice)
- Add pepper and fry for a further 5 minutes.
- Add TVP mince and bean mix and the can of chopped tomatoes, cook for 20 – 30 minutes
- Add salt and pepper to taste
- Add pearl cous cous to a large pot of boiling water and cook for 6 – 10 minutes until they
are cooked through, Strain and put in a serving dish
- Serve and enjoy'),
('Bread Salad', 4, '
- Roughly cut your loaf of bread into cubes about 2cm big
- Heat some oil in a frying pan and in batches lightly fry the chunks of bread then set aside
- Finely chop the garlic and onions
- Half the cherry tomatoes and chop the heritage tomatoes into chunks
- Cut the courgette in half lengthways then slice each half up
- Combine all of the vegetables and the fried bread in a bowl, add 2 tbsp oil and salt and
pepper to taste
- Serve and enjoy');

INSERT INTO RecipeIngredients VALUES
(1,14,2,13),(1,15,3,7),(1,16,2,8),(1,17,2,1),(1,18,2,1),(1,19,3,1),(1,2,300,2),(1,20,1,11),(1,1,400,2),
(2,3,1,11),(2,17,2,1),(2,14,2,13),(2,21,4,15),(2,19,2,1),(2,22,2,1),(2,23,1,12),(2,24,500,4),(2,4,150,2),
(3,5,400,2),(3,14,4,13),(3,25,2,1),(3,26,4,1),(3,17,2,1),(3,24,800,4),(3,28,1,1),(3,32,1,1),(3,39,2,7),
(4,14,2,13),(4,15,2,7),(4,27,1,16),(4,6,200,2),(4,17,1,1),(4,25,1,1),(4,28,1,1),(4,29,1,1),(4,20,1,11),(4,1,200,2),
(5,14,2,13),(5,17,1,1),(5,19,1,1),(5,28,1,1),(5,2,200,2),(5,22,1,1),
(6,30,200,2),(6,31,1,1),(6,32,0.5,1),(6,29,1,1),(6,14,2,13),(6,33,60,2),(6,28,1,1),(6,19,1,1),
(7,27,1,16),(7,14,2,13),(7,34,1,8),(7,17,1,1),(7,19,1,1),(7,35,6,1),(7,24,1,5),(7,7,2,17),
(8,36,2,9),(8,8,1,9),(8,9,1,7),(8,37,400,4),(8,38,1,7),
(9,10,1,11),(9,17,2,1),(9,25,2,1),(9,11,200,2),(9,2,60,2),(9,39,1,8),(9,14,2,13),(9,12,500,2),
(10,13,1,14),(10,26,200,2),(10,33,200,2),(10,32,2,1),(10,28,1,1),(10,38,1,8),(10,14,2,13);


INSERT INTO Ingredients (IngredientName, AllergenID, ShopLink) VALUES
('tinned chickpeas', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-veg-pulses?variant=41840322019485'),
('tinned kidney beans', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-veg-pulses?variant=41840331554973'),
('tinned black beans', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-veg-pulses?variant=41840334962845'),
('tinned baked beans', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-veg-pulses?variant=41840336175261'),
('tinned mixed beans', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-veg-pulses?variant=41840341909661'),
('oat milk', 1, 'https://thelittlegreenlarder.com/collections/grocery-items/products/oat-milk-1'),
('vegan baked beans and sausages', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-meals'),
('vegan baked beans and burgers', 5, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-meals?variant=41840361078941'),
('vegan spicy chorizo stew', 1, 'https://thelittlegreenlarder.com/collections/grocery-items/products/tinned-meals?variant=41840363995293'),
('porridge oats', 7, 'https://thelittlegreenlarder.com/collections/cereal/products/porridge-oats'),
('fruit and nut muesli', 2, 'https://thelittlegreenlarder.com/collections/cereal/products/fruit-and-nut-muesli'),
('granola', 7, 'https://thelittlegreenlarder.com/collections/cereal/products/granola'),
('bran sticks', 1, 'https://thelittlegreenlarder.com/collections/cereal/products/bran-sticks'),
('jumbo oats', 1, 'https://thelittlegreenlarder.com/collections/cereal/products/jumbo-oats'),
('pinhead oatmeal', 1, 'https://thelittlegreenlarder.com/collections/cereal/products/pinhead-oatmeal'),
('broth mix', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/broth-mix'),
('red lentils', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/red-lentils'),
('speckled lentils', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/speckled-lentils'),
('yellow split peas', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/yellow-slit-peas'),
('marrowfat peas', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/marrowfat-peas'),
('soya beans', 4, 'https://thelittlegreenlarder.com/collections/pulses/products/soya-beans'),
('butter beans', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/butter-beans'),
('pinto beans', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/pinto-beans'),
('red kidney beans', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/red-kidney-beans'),
('black eye beans', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/black-eye-beans'),
('black beans', 5, 'https://thelittlegreenlarder.com/collections/pulses/products/black-beans'),
('white linguine', 7, 'https://thelittlegreenlarder.com/collections/pasta/products/white-linguine'),
('fusilli', 7, 'https://thelittlegreenlarder.com/collections/pasta/products/fusilli'),
('macaroni', 7, 'https://thelittlegreenlarder.com/collections/pasta/products/macaroni'),
('penne', 7,'https://thelittlegreenlarder.com/collections/pasta/products/penne'),
('lasagne', 7, 'https://thelittlegreenlarder.com/collections/pasta/products/lasagne-sheets'),
('whole wheat pasta', 7, 'https://thelittlegreenlarder.com/collections/pasta/products/whole-wheat-pasta-organic'),
('black rice', 1, 'https://thelittlegreenlarder.com/collections/rice/products/black-rice-organic'),
('quinoa', 1, 'https://thelittlegreenlarder.com/collections/rice/products/organic-quinoa'),
('sushi rice', 1, 'https://thelittlegreenlarder.com/collections/rice/products/sushi-rice'),
('jasmine rice', 1, 'https://thelittlegreenlarder.com/collections/rice/products/jasmine-rice'),
('long grain white rice', 1, 'https://thelittlegreenlarder.com/collections/rice/products/long-grain-white-rice'),
('bulgur wheat', 7, 'https://thelittlegreenlarder.com/collections/rice/products/organic-bulgur-wheat'),
('mung beans', 5, 'https://thelittlegreenlarder.com/collections/rice/products/organic-mung-beans'),
('tricolour quinoa', 1, 'https://thelittlegreenlarder.com/collections/rice/products/tricolour-quinoa'),
('popcorn', 1, 'https://thelittlegreenlarder.com/collections/rice/products/popcorn'),
('pearl barley', 7, 'https://thelittlegreenlarder.com/collections/rice/products/pearl-barley'),
('long grain brown rice', 1, 'https://thelittlegreenlarder.com/collections/rice/products/long-grain-brown-rice'),
('cashews', 2, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/broken-cashews'),
('mixed seeds', 3, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/mixed-seeds'),
('pumpkin seeds', 1, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/pumpkin-seeds'),
('wallnuts', 2, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/wallnuts'),
('mixed nuts', 2, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/mixed-nuts'),
('sunflower seeds', 1, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/sunflower-seeds'),
('peanuts', 2, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/peanuts-blanched'),
('red skin peanuts', 2, 'https://thelittlegreenlarder.com/collections/nuts-and-seeds/products/red-skin-peanuts');

INSERT INTO Ingredients VALUES
(91,'Cauliflower',1,NULL,0),
(92,'Millet',1,NULL,0),
(93,"All-purpose flour",7,NULL,0),
(94,"Yeast flakes",1,NULL,0),
(95,"Salad cheese",10,NULL,0),
(96,'Butter',10,NULL,0),
(97,'Kale',1,NULL,0),
(98,'Edamame',4,NULL,0),
(99,'Cabbage',1,NULL,0),
(100,'Mango',1,NULL,0),
(101,"Peanut butter",2,NULL,0),
(102,'Honey',1,NULL,0),
(103,'Vinegar',1,NULL,0),
(104,'Cucumber',1,NULL,0),
(105,'Nori',1,NULL,0),
(106,'Sultanas',1,NULL,0),
(107,'Cheddar',10,NULL,0),
(108,'Spinach',1,NULL,0),
(109,'Pesto',2,NULL,0),
(110,'Egg',11,NULL,0),
(111,"Dried apricots",1,NULL,0),
(112,"Puff pastry",7,NULL,0),
(113,"Butternut squash",1,NULL,0),
(114,'Cranberries',1,NULL,0),
(115,'Pistachios',2,NULL,0),
(116,"Smoked paprika",1,NULL,1),
(117,"Garlic salt",1,NULL,1),
(118,"Lemon zest",1,NULL,1),
(119,"Milled linseed",1,NULL,1),
(120,'Za\'atar',1,NULL,1),
(121,"Ground cumin",1,NULL,1),
(122,"Ground coriander",1,NULL,1),
(123,"Fresh thyme",1,NULL,1),
(124,"Fresh rosemary",1,NULL,1),
(125,'seasalt',1,NULL,1),
(126,'Tamari',1,NULL,1),
(127,"Dried thyme",1,NULL,1),
(128,"Garlic powder",1,NULL,1),
(129,'Chilli',1,NULL,1),
(130,"TVP mince",1,NULL,0),
(131,"Spring onions",1,NULL,1),
(132,'Saffron',1,NULL,1),
(133,"Almond flakes",1,NULL,1),
(134,"Dijon mustard",1,NULL,1),
(135,'Breadcrumbs',1,NULL,1),
(136,'Cajun',1,NULL,1),
(137,"garden peas",5,NULL,0),
(138,"spring/summer greens",1,NULL,0),
(139,"summer green leaves",1,NULL,0),
(140,"fresh coriander",1,NULL,1),
(141,'asparagus',1,NULL,0),
(142,"sweetcorn cob",1,NULL,0),
(143,"single/double cream",10,NULL,0),
(144,"chipotle paste",1,NULL,1),
(145,"BBQ sauce",1,NULL,1),
(146,"feta cheese",10,NULL,0),
(147,'aubergine',1,NULL,0),
(148,"fresh basil",1,NULL,1),
(149,'turnip',1,NULL,0),
(150,'apple',1,NULL,0),
(151,'celeriac',6,NULL,0),
(152,'lemon',9,NULL,0),
(153,'leek',1,NULL,0),
(154,'ricotta',10,NULL,0),
(155,'clementine',1,NULL,0),
(156,'pear',1,NULL,0),
(157,'dates',1,NULL,0),
(158,"dried fruit",1,NULL,0),
(159,"maple syrup",8,NULL,1);

INSERT INTO Recipes VALUES
(11,'Vegan Spring Green and Pea Risotto','',15,40,55,2,
'In a medium saucepan, bring the stock to simmer.
Meanwhile, add a little oil to a deep frying pan or saucepan over a medium-low heat. Add the onion and garlic and cook for 8-10 minutes or until soft. Now add the thyme and rice and stir for a couple of minutes until it starts to become translucent.
Add the bay leaf and white wine and cook for 1-2 minutes. Now turn the heat down, add one ladle of stock and stir to combine until it is fully absorbed. Stirring during the cooking helps to release the starch from the rice and create a creamy texture.
Continue to add the stock, one ladle at a time, stirring continuously until the rice is almost cooked al dente (depending on the type of rice there may be leftover stock). Now add the miso, nutritional yeast, a ladle of stock and salt. Stir until everything is well mixed. Then, add the peas and let them cook for 2-3 minutes and finally stir in the greens and cook for another 2-3 minutes.
Remove from the heat, divide between two bowls and garnish with lemon zest and fresh oregano or thyme on top.

Recipe source: https://www.riverford.co.uk/recipes/vegan-spring-green-pea-risotto',0),
(12,'Avocado and Chickpea Summer Green Wraps',Null,20,0,20,6,
'Place all the filling ingredients in a medium mixing bowl and mix everything with a spoon until the avocado binds all the ingredients together. Taste and adjust the lemon, oil and seasoning to your liking. At this stage you can add some fresh chilli or chilli flakes to the mix if you like it spicy.
Lay a summer green leaf flat on a chopping board and cut out the thick part of the stalk, so you have a long, tall triangle shape cut out from the middle, making sure to leave the top third of the leaf whole and intact. Bring one side of the cut leaf over the other to fill the stalk gap.
Scoop some of the mixture into the middle of the leaf and carefully fold the sides in, so one overlaps the other. Close the wrap by rolling the leaf from the bottom to the top and place it with the seam down onto a plate. Repeat the process with the rest of the ingredients.

Recipe source: https://www.riverford.co.uk/recipes/avocado-chickpea-summer-green-wraps', 0),
(13,'Asparagus Minestrone with Cannellini Beans',Null,20,20,40,2,
'Put a kettle on to boil. Wash and finely dice the celery stalk. Trim and finely slice the spring onions. Roughly chop the tomatoes. Peel and finely chop 1 garlic clove. Pod the broad beans and pop them in a bowl. Tip over some boiling water and leave them for a few minutes.
While you wait, measure 800ml of boiling water and crumble in the stock cube. Whisk until dissolved. Drain the beans and take a few minutes to slip the beans from their skins. Remove the woody ends from the asparagus, roughly the bottom 2cm, discard them.
Slice the stalks into 1cm pieces, keeping the tips whole. Peel the potato and cut it into small half cm dice. Heat 2 tablespoons of oil in the saucepan and add the diced celery. Fry gently for 5 minutes. Add the potato, spring onions, garlic, bay and chopped tomatoes.
Fry gently for a further 5 minutes. Pour in the stock and bring to a simmer. Cook gently for 10-12 minutes until the potatoes are tender. In the meantime, strip the spring green leaves from the stalks. Discard the stalks and wash the leaves well. Roll them up together and shred them as finely as you can.
Drain the cannellini beans and add them to the pan. Let them warm through for a few minutes. Add the broad beans, asparagus and spring greens to the pan. Simmer gently for 3 minutes until they are all just cooked. Check the seasoning and adjust with salt, pepper and a squeeze or 2 of lemon juice to your taste.
Ladle the minestrone between deep bowls. Serve with a blob of pesto on top and a scattering of Italian cheese.

Recipe source: https://www.riverford.co.uk/recipes/asparagus-minestrone-with-greens',0),
(14,'Sweetcorn and Courgette Pasta',Null,10,20,30,3,
'Cook the pasta al dente according to the package instructions, then drain and reserve a mugful of the pasta water.
Heat a little olive oil in a frying pan over a medium-low heat. Add the onion and cook for 8-10 minutes until soft and translucent.
Stir in the courgette and sweetcorn and cook for 5-8 minutes, or until the vegetables are cooked and tender. Now add the smoked paprika and cream and season with salt and pepper to taste.
Let the sauce simmer for 2-3 minutes, then toss in the drained pasta and a splash of the pasta water if necessary. Taste and adjust seasoning. Divide into two bowls and garnish with fresh herbs before serving.

Recipe source: https://www.riverford.co.uk/recipes/sweetcorn-courgette-pasta',0),
(15,'Chipotle,Black Bean,Corn and Spinach Chilli',Null,15,25,40,2,
'Peel and finely grate the garlic. Cut the kernels off the sweetcorn cob.
Chop the sweet potato or squash into bite-sized chunks - no need to peel it, unless you prefer to.
Slice the chillies into thin rings. Halve, peel and dice the onion.
Drain and rinse the black beans (you just need half the tin in this recipe).
In a large saucepan, toast the pumpkin seeds on a medium heat for approx. 2 minutes, until they start to pop and change colour slightly. Transfer to a plate.
Heat 1 tbsp of oil in the same pan. Fry the onion for 2 minutes, then add the sweetcorn and sweet potato and fry for a further 3 minutes.
Stir in the garlic, spices, thyme, chipotle paste and BBQ sauce. Stir for 1 minute.
Add chilli to your taste, the passata, cherry tomatoes (whole), black beans and 200ml of water. Season with salt and pepper. Bring to a simmer and cook for approx. 15 minutes, until the sweet potato or squash is tender. Stir now and then and keep an eye on the liquid.
Chop the coriander, stalks and all. Halve, destone and dice the avocado.
Stir in the spinach in handfuls, until just wilted.
Check the chilli seasoning, adding three-quarters of the coriander and some lime juice to taste.
Serve scattered with avocado, pumpkin seeds, remaining coriander and more chilli to your taste.

Recipe source: https://www.riverford.co.uk/recipes/chipotle-black-bean-corn-spinach-chilli',0),
(16,'Baked Feta and Summer Veg Orzo',Null,10,45,55,3,
'Preheat oven to 200°C/Gas 6. To a large baking dish, add the garlic, onion, tomatoes, courgette and aubergine. Add a little oil, salt and pepper and toss everything together.
Make a gap and place the feta block in the middle of the dish. Drizzle a little olive oil on top of the cheese and bake for 40-45 minutes, or until the vegetables are cooked and the feta is very soft and golden.
Meanwhile, cook the pasta al dente according to the pack instructions. Before draining, reserve half a cup of pasta water in case you need it for later.
Remove the baking dish from the oven, add the lemon zest and chopped basil and stir everything until the feta has melted into a creamy sauce. Now add the cooked pasta and toss until evenly coated. If the consistency is too thick, loosen the mixture with a few tablespoons of pasta water. Taste and adjust seasoning if necessary and garnish with basil leaves on top before serving.

Recipe source: https://www.riverford.co.uk/recipes/baked-feta-summer-veg-orzo',0),
(17,'Chickpea and Summer Veg Tagine',Null,15,35,50,2,
'Boil a kettle. Put the couscous in a heatproof bowl, or saucepan, with a pinch of salt. Cover the couscous by 1cm with boiled water. Cover it with a plate, or lid, and set aside.
Heat ½ tbsp of oil in a large saucepan. Fry the turnip and carrots for 3 mins, on a high heat, to colour it a little. Reduce the heat and continue gently frying.
Stir the onions into the turnip and carrot for 2 mins, then stir in the garlic for 1 min.
Stir in the tomato purèe, tagine spices (coriander, cumin, ginger, cinnamon, turmeric), harissa, preserved lemon rind, apricots, then the chickpeas, including their liquid. Refill the tin ⅓ full of water; add that. Season. Cook on a low boil for 10-12 mins, until the turnip and carrots are tender with a little bite. Stir and check the liquid at intervals; add a splash more water if needed.
When the veg is ready, stir in the spinach, handful by handful, until just wilted. Stir in the dried dill tops and ¾ of the fresh herbs. Season and add lemon juice, to taste.
Fluff the couscous up with a fork. Serve it with the tagine, sprinkled with remaining herbs.

Recipe source: https://www.riverford.co.uk/recipes/chickpea-summer-veg-tagine',0),
(18,'Celeriac,Apple and White Bean Soup',Null,10,30,40,2,
'Warm 1 tbsp of oil in a large saucepan and cook the onion gently for 10 mins, until starting to soften.
Peel and chop half the apple; keep the rest for later.
Add the garlic, celeriac, apple, and thyme to the pan, and cook gently for a further 5 mins.
Drain the beans and add them to the pan, along with the water/stock. Bring to a simmer and sea-son with salt and pepper. Cook gently for 20 mins, until everything is soft.
When ready, add the mustard. Blend it until completely smooth, adding a dash more hot water if it seems too thick. Taste and tweak with salt, pepper, and a squeeze or so of lemon juice to your liking.
Serve and garnish with the parsley, finely diced apple, and hazelnuts.

Recipe source: https://www.riverford.co.uk/recipes/celeriac-apple-white-bean-soup',0),
(19,'Leek and Lemon Spaghetti',Null,5,240,245,2,'
Turn your slow cooker on and pour in the stock (see step 2 if for cooking times if you\'re not sure what setting to put it on). Cut the leek down the middle lengthways, leaving the root end intact, and fan it out to wash in-between the layers with water. Cut in half or thirds (about 8-10 cm long) then cut each piece in half lengthways. Cut each half, laying it flat side down, into three or four, so you have ribbons of leek about 1cm wide.
Add the leeks to the slow cooker with the lemon zest and herbs. Put the lid on and cook on low for 4-8 hours, or on high for 2 hours.
About 15 minutes before serving, add your pasta (if it\'s on a low setting, turn it up to high before adding your pasta). Give it a good stir so the pasta sits in the liquid rather than on top of the leeks. If you think you need to add more liquid, add a dash of boiling water, but you shouldn\'t need to add much or any at all, or your dish will be watery. Cook the pasta with the lid on.
Taste test the pasta after the suggested cooking time on the package instructions. You might need to give it a bit of extra time. Once almost cooked, add your cheese, and the juice of half the lemon. Taste and adjust with more lemon and salt, if needed. Leave for a few more minutes so the ricotta comes up to temperature too, and doesn\'t cool the dish.
Divide between bowls and finish with a generous grind of pepper, and fresh herbs if you like too.

Recipe source: https://www.riverford.co.uk/recipes/slow-cooker-leek-lemon-spaghetti',0),
(20,'Black Bean, Mushroom and Ginger Stew',Null,25,40,65,2,
'Bring a medium pan of salted water to boil. Add the potatoes and cook for 20-25 minutes or until very tender. Drain and return to the pan. Add the rest of the mash ingredients and crush to a soft consistency. Add more plant-based milk and season if needed. Cover to keep warm.
Meanwhile, heat a little olive oil in a medium saucepan over a medium heat. Add the onions and cook for 8-10 minutes or until translucent. Stir in the mushrooms and thyme and cook for 5-8 minutes, or until the mushrooms turn golden-brown. Season with salt and pepper.
Add the black beans and their liquid, the tamari/soya sauce and 200ml of water. Let it simmer gently for 15-20 minutes, stirring occasionally, until the stew has thickened. Taste and adjust seasoning if needed.
Peel and finely grate the ginger. Squeeze the juice from the ginger over the black bean stew and mix it well. Discard the ginger pulp.
Spoon the hot mash potato into two serving bowls. Ladle in the stew and garnish with chopped fresh parsley, if desired.

Recipe source: https://www.riverford.co.uk/recipes/black-bean-mushroom-ginger-stew',0),
(21,'Christmas Chutney',Null,20,70,90,4,
'Pop the onions, courgette and clementine zest and juice into a large, heavy-based, stainless-steel pan (other metals can react with the acidic ingredients). Add the vinegar, sugar, mixed spice and salt. Stir together and bring to a gentle simmer. Cook gently, stirring occasionally, for 30 mins while you prepare the rest of the ingredients.
After the mix has cooked for 30 mins, add the diced apples, pears and ginger along with the chopped dates, dried mixed fruit and cranberries. Add about 100ml of water, return to a simmer and cook for a further 40 mins, until the liquid is dark and thickened and the fruit is cooked. If it looks like drying out before this, add a dash or two of water as needed – the dates soak up water as they cook and thicken.
When ready, taste and add a little cayenne pepper to your liking.
Leave to cool for 10 mins before decanting into the sterile jars. Screw the lids on tight and pop on labels with the name and date made. It is best left to mature for at least 2 weeks before opening, and will keep well for 3 months. Refrigerate once opened.

Recipe source: https://www.riverford.co.uk/recipes/christmas-chutney',0),
(22,'Squash,Clementine and Bulghur Christmas Salad',Null,20,25,45,4,
'Preheat your oven to 200°C/Gas 6. Put a kettle on to boil.
Tip the bulghur wheat into a heatproof jug or bowl, along with the cinnamon, cardamom, star anise, a generous pinch of salt, and 1 tbsp of olive oil. Stir it together to coat the grains. Pour over enough boiling water to cover it by 2cm, cover with a plate, and set aside to soak and plump up while you continue.
Finely zest both clementines; keep the zest to one side. Remove what is left of the peel, then slice the clementines into thin discs. Peel, deseed and chop the Butternut into 3cm pieces. Pop them in a roasting tray with the sliced clementines, 2 tbsp of olive oil, and the mixed spice. Season and mix well. Transfer to the oven and roast for 25 mins, until the Butternut is tender and starting to colour at the edges.
Meanwhile, peel and finely slice the red onion; if it’s much bigger than a golf ball, you’ll only need to use half. Mix it in a small bowl with the vinegar. Leave to pickle, turning occasionally – the vinegar takes the raw edge away from the onions.
Coarsely chop the hazelnuts and cranberries. Pick the parsley leaves from the stalks and finely chop them.
When the Butternut is ready, you can choose to let it cool before building the salad. To build, give the bulghur wheat a stir to separate the grains, and pluck out the spices. Add it to the tray along with the watercress, clementine zest, maple syrup and 1 more tbsp of olive oil. Mix well, taste, and tweak with more salt to your liking; if you want even more sharpness you can mix in a dash of the vinegar from the onions too.
To serve, pile it on to a serving plate and garnish artfully with the hazelnuts, cranberries, parsley and drained onions.

Recipe source: https://www.riverford.co.uk/recipes/spiced-squash-clementine-christmas-salad',0),
(23,'Slow Cooker Dal',Null,10,360,370,4,
'Add everything to your slow cooker. Stir well. Set the slow cooker to high if you want to eat in 3 hours or so, or set to low if you want to cook overnight/all day.
After 3 hours (or the next morning), taste to check the seasoning and that the lentils are cooked. Add more water if you think the consistency is too thick – you want a loose-porridge like consistency. If using, add leafy veg 10 minutes or so before serving, stirring through so it wilts in the heat.
Serve with rice or naan bread. If cooking overnight to eat the next day, just turn off the slow cooker in the morning and reheat before serving.

Recipe source: https://www.riverford.co.uk/recipes/slow-cooker-dal',0);



DROP TABLE IF EXISTS RecipeSeasonal;
CREATE TABLE RecipeSeasonal(
RecipeID int,
SeasonID smallint,
Primary Key(RecipeID,SeasonID));

DROP TABLE IF EXISTS Seasons;
CREATE TABLE Seasons(
SeasonID smallint,
SeasonName varchar(10),
Primary Key(SeasonID));


ALTER TABLE RecipeSeasonal ADD CONSTRAINT SeasonKey FOREIGN KEY (SeasonID) REFERENCES Seasons (SeasonID);
ALTER TABLE RecipeSeasonal ADD CONSTRAINT Recipe_Key FOREIGN KEY (RecipeID) REFERENCES Recipes (RecipeID);



INSERT INTO RecipeIngredients VALUES
(11,24,800,4),(11,17,1,1),(11,14,2,13),(11,123,3,16),(11,5,175,2),(11,94,3,7),(11,137,60,2),(11,138,80,2),(11,118,1,1),
(12,139,8,1),(12,40,400,2),(12,25,1,1),(12,131,0.5,12),(12,31,2,1),(12,140,15,2),(12,118,1,1),(12,38,2,8),
(13,21,1,15),(13,131,1,12),(13,26,2,1),(13,14,1,13),(13,61,300,2),(13,24,1,16),(13,141,1,12),(13,22,1,1),(13,138,100,2),(13,3,1,11),(13,109,2,7),
(14,71,150,2),(14,17,1,1),(14,28,2,1),(14,142,1,1),(14,116,2,8),(14,143,150,4),(14,23,0.5,12),
(15,14,2,13),(15,142,1,1),(15,18,300,2),(15,129,2,1),(15,32,1,1),(15,42,1,11),(15,121,1,8),(15,122,1,8),(15,127,1,8),(15,144,1,7),(15,10,200,4),(15,33,250,2),(15,140,1,12),(15,108,150,2),(15,29,1,1),
(16,146,200,2),(16,14,2,13),(16,17,1,1),(16,33,250,2),(16,28,1,1),(16,147,1,1),(16,4,200,2),(16,152,1,1),(16,148,10,2),
(17,12,100,2),(17,149,1,1),(17,19,2,1),(17,131,125,2),(17,14,1,13),(17,118,1,1),(17,40,1,11),(17,111,20,2),(17,10,1,7),(17,122,1,8),(17,121,1,8),(17,23,10,2),(17,140,15,2),(17,108,150,2),(17,152,1,1),
(18,17,1,1),(18,150,1,1),(18,14,1,13),(18,151,450,2),(18,123,1,8),(18,3,1,11),(18,24,600,4),(18,134,0.5,7),(18,152,1,1),
(19,24,500,4),(19,153,400,2),(19,152,1,1),(19,154,250,2),
(20,22,2,1),(20,38,2,7),(20,37,100,4),(20,17,1,1),(20,35,250,2),(20,123,5,2),(20,42,400,2),(20,34,2,7),(20,27,40,2),
(21,17,2,1),(21,28,2,1),(21,155,1,1),(21,103,200,4),(21,8,180,2),(21,150,4,1),(21,156,2,1),(21,27,25,2),(21,157,40,2),(21,158,75,2),(21,114,25,2),
(22,77,100,2),(22,155,2,1),(22,113,1,1),(22,32,1,1),(22,103,2,7),(22,114,25,2),(22,86,40,2),(22,159,1,7),
(23,17,1,1),(23,14,2,13),(23,27,30,2),(23,121,2,8),(23,122,2,8),(23,16,1,8),(23,129,0.5,8),(23,10,200,2),(23,56,400,2),(23,24,800,4);

INSERT INTO Seasons VALUES
(1,'Spring'),(2,'Summer'),(3,'Autumn'),(4,'Winter');

INSERT INTO RecipeSeasonal VALUES
(11,1),(12,1),(12,2),(13,1),(14,2),(15,2),(15,3),
(16,2),(17,2),(18,3),(18,4),(19,3),(20,3),(20,4),(21,4),(22,4),(23,4);


INSERT INTO Recipes(RecipeName, Servings, PrepTime, CookTime, TotalTime, Instructions) VALUES
('Cauliflower and chickpea stew',1,30,30,60,'
1.  Heat the oil in a saucepan or frying pan. Add the onion and sweat over a low heat for 5 minutes until softening. Add the garlic and spices and cook for 1 minute until fragrant. 
2.  Add the cauliflower, tomatoes, chickpeas and the liquid from the tin and cook on a low simmer for 15 minutes until the cauliflower is tender. 
3.  Meanwhile, rinse the rice and cook according to packet instructions. 
4.  Add the peas to the cauliflower mixture and cook for 2 minutes. Season with the lime juice, salt and pepper. Stir through most of the parsley and serve with the rice.

https://www.bbc.co.uk/food/recipes/cauliflower_and_chickpea_82819'),
('Millet & Black Lentil Stuffed Delicata Squash',8,15,45,60,'
Preheat your oven to 400F and line two baking sheets with parchment or foil. Spray or brush both sides of the squash with oil. Place the squash, cut side down, on the baking sheets. Roast for 25-35 minutes, or until the squash are fork tender and browning.
While the squash halves roast, heat the oil in a medium sized pot. Add the onion, celery, and carrots. Cook, stirring every now and then, for 5-7 minutes, or until the onion is soft and clear. Add the garlic and millet. Toast the millet for about 2 minutes, or until it smells a bit nutty. Add the salt and broth. Bring the millet to a boil, reduce the heat to low, cover, and simmer for 20-25 minutes, or until the lentils are tender (but a little al dente) and the millet has absorbed all of the liquid. Remove the millet from heat and allow it to steam while you make the gravy.
To prepare the gravy, heat the flour and nutritional yeast in a small saucepan over medium heat. Stir them frequently, and continue cooking until they smell toasted and the flour is just golden (about 5 minutes). Remove them from heat and whisk in the vegetable broth, tamari, olive oil, thyme, and garlic powder. Return the mixture to low heat and cook, whisking constantly, until the gravy is thick and bubbly. Season to taste with black pepper and remove from heat.
When the squash halves are ready, flip them over. Taste the millet and black lentil stuffing and adjust salt and pepper as needed. Stuff each squash half with the stuffing, then top with the gravy (or another sauce or dressing). Serve.
Notes:
Millet and black lentil stuffing can be prepared a day in advance, and the squashes can be roasted a day in advance. Gravy can be prepared up to 2 days in advance, or frozen for up to 3 weeks.

https://www.thefullhelping.com/millet-black-lentil-stuffed-delicata-squash'),
('Pearl barley and tomato risotto recipe',4,10,40,50,'
Heat the 1 tbsp oil from the tomato jar in a large, lidded saucepan over a medium-low heat. Add the onion, garlic and parsley stems and cook, stirring occasionally, for 5-7 mins until soft and translucent. Stir in the pearl barley, sundried tomatoes, chopped tomatoes and stock.
Bring to the boil, then cover and reduce the heat to low. Simmer for 30-40 mins, stirring occasionally, until the barley is just cooked and all the liquid has been absorbed.
Give the barley a good stir until it’s released its starch and the risotto is creamy; season with pepper. Stir in the cheese and parsley leaves to serve.
Tip: To make it vegan, use a stock pot instead of a cube and swap the feta for 2 tbsp nutritional yeast.

https://realfood.tesco.com/recipes/pearl-barley-and-tomato-risotto.html'),
('Pearl Couscous',6,5,15,20,'
Step 1: Melt butter in a preheated saucepan over medium high heat.
Step 2: Add couscous and sauté until nice and golden, stirring frequently, 3-5 minutes.
TIP: Make sure to stir couscous frequently, while toasting to avoid burning.
Step 3: Add broth and bring it to a simmer.
Step 4: Reduce heat to simmer and cover the pot. Continue to cook for about 10 minutes, or until the liquid is absorbed and couscous is soft.

https://www.busycooks.net/how-to-cook-pearl-couscous/'),
('Popcorn',4,0,10,10,'
STEP 1
Heat the oil in a 3-quart saucepan on medium high heat. If you are using coconut oil, allow all of the solid oil to melt.
STEP 2
Put 3 or 4 popcorn kernels into the oil and cover the pan.
STEP 3
When the kernels pop, add the rest of the 1/3 cup of popcorn kernels in an even layer. Cover, remove from heat and count 30 seconds. (Count out loud; it\'s fun to do with kids.) This method first heats the oil to the right temperature, then waiting 30 seconds brings all of the other kernels to a near-popping temperature so that when they are put back on the heat, they all pop at about the same time.
STEP 4
Return the pan to the heat. The popcorn should begin popping soon, and all at once. Once the popping starts in earnest, gently shake the pan by moving it back and forth over the burner. Try to keep the lid slightly ajar to let the steam from the popcorn release (the popcorn will be drier and crisper). Once the popping slows to several seconds between pops, remove the pan from the heat, remove the lid, and dump the popcorn immediately into a wide bowl. With this technique, nearly all of the kernels pop, and nothing burns.
STEP 5
If you are adding butter, you can easily melt it by placing the butter in the now empty, but hot pan. Note that if you let the butter get just a little bit brown, it will add an even more intense, buttery flavor to the butter and to your popcorn.  Just drizzle the melted butter over the popcorn and toss to distribute.
STEP 6
Add salt to taste

https://www.simplyrecipes.com/recipes/perfect_popcorn/'),
('Thai quinoa salad', 4,35,15,50,'
QUINOA: Prepare the quinoa by rinsing it under cold water in a fine mesh sieve to remove the bitter saponin coating. Combine the quinoa and 1 cup water in a small pot over high heat. Bring to a boil, add in 1/2 teaspoon fine sea salt (or to taste), reduce the heat to low, and cover the pot. Simmer for 10-15 minutes or until the liquid is absorbed. Remove from heat, keep the quinoa covered, and let stand for 10-15 minutes. Fluff with a fork and place in the fridge or freezer to cool to room temperature.
EDAMAME: Meanwhile, bring a pot with 6 cups of water to a boil, then add in 1 tablespoon fine sea salt, and the 1 cup of frozen and shelled edamame. Cook for 2-3 minutes or until edamame is tender. Drain thoroughly.
KALE: Remove the thick stems and then very thinly slice (ribbon) the kale. The smaller the shreds of kale, the better! Once it\'s all chopped, put it in a colander (or the base of a salad spinner) and give it a quick rinse. Rub and massage the kale for about a minute and then give it another quick rinse. Allow the kale to dry completely before using in the salad or spin in the salad spinner to dry it quickly.
VEGGIE/FRUIT PREP: Thinly slice the cabbage or measure out 2 cups of coleslaw mix. Coarsely chop the red pepper, mango, cilantro (and then loosely measure to get 1/2 cup) and the cashews. Thinly slice the green onions.
DRESSING: Place 1/4 cup creamy peanut butter, 3 tablespoons honey, 2 tablespoons olive oil, 2 tablespoons hot water, coarsely chopped garlic clove, 1 and 1/2 tablespoons rice vinegar, 1 and 1/2 tablespoons low sodium soy sauce, 1/8 teaspoon pepper, and 1/4 teaspoon salt in a small blender jar. Process until smooth and refrigerate while preparing everything else.
SALAD ASSEMBLY: Combine the cooked and completely cooled quinoa, shredded kale, coleslaw/cabbage, red pepper, carrots, mango, cilantro, green onions, and cashews in a large bowl. Drizzle with dressing (to desired preference; we use all the dressing, but you may prefer less; see instruction #7). Toss to combine and enjoy!
STORAGE: This salad doesn\'t sit well with the dressing, so only dress what will be enjoyed the same day. Store any leftover salad and dressing separately.

https://www.chelseasmessyapron.com/thai-quinoa-salad/'),
('Vegan Sushi',2,20,10,30,'
STEP 1
Put the rice in a small pan with 600ml water. Bring to the boil and cook for 10 mins until the water is absorbed and the rice is tender. Stir through the vinegar and sugar, cover and cool.
STEP 2
Skin, stone and slice the avocado. Put in a bowl and squeeze over the lemon juice, turning the avocado to ensure the pieces are covered.
STEP 3
Divide the rice between the nori sheets and spread it out evenly, leaving a 1cm border at the top and bottom. Lay your favourite fillings over the rice, followed by the chives and finally position the avocado across the centre.
STEP 4
Fold the bottom edge of the seaweed over the filling, then roll it up firmly. Dampen the top border with a little water to help it seal the roll. Repeat to make 4 rolls. At this stage, the rolls can be wrapped individually in cling film and chilled until ready to serve.
STEP 5
Using a serrated knife, cut each roll into 8 rounds. Serve with sweet soy sauce for dipping.

https://sarahsveganguide.com/vegan-sushi-guide'),
('Bulgar wheat salad',1,5,15,20,'
STEP 1
Heat the oven to 200C/fan 180C/gas 6. Cover the bulgar wheat with boiling water, cover with clingfilm and leave to absorb for 10-15 minutes. Drain well. Pour 1 tbsp hot water from a kettle over the sultanas and saffron in a small bowl.

STEP 2
Toss the red onion, flaked almonds, red wine vinegar and bulgar, and season. Add the sultanas and their juice and season well. Toss the rocket with the salad, and serve with the sliced chicken. Drizzle with more pomegranate molasses.

https://www.olivemagazine.com/recipes/healthy/pomegranate-roasted-chicken-with-bulgar-wheat-salad/'),
('Vegetarian lasagne',6,30,90,120,'
Preheat the oven to 200C/180C Fan/Gas 6. Put the peppers, courgette and sweet potato into a large baking tray. Drizzle with 2 tablespoons of the oil, season with salt and pepper and toss together.
Roast for 30 minutes, or until softened and lightly browned.
While the vegetables are roasting, heat the remaining oil in a large saucepan and gently fry the onion for 5 minutes, stirring regularly.
Add the chilli and garlic and cook for a few seconds more. Stir in the tomatoes, Italian seasoning (or dried oregano) and crumbled stock cube. Pour over the water and bring to a gentle simmer. Cook for 10 minutes, stirring regularly. Set aside.
For the cheese sauce, put the flour, butter and milk in a large saucepan and place over a medium heat. Whisk constantly with a large metal whisk until the sauce is thickened and smooth. (Use a silicone covered whisk if cooking in a non-stick pan.) Stir in roughly two-thirds of the cheeses and season to taste.
Take the vegetables out of the oven and add to the pan with the tomato sauce. Stir in the spinach and cook together for 3 minutes. Season with salt and lots of ground black pepper.
Spoon a third of the vegetable mixture over the base of a 2½ –3 litre/4½–5¼ pint ovenproof lasagne dish and cover with a single layer of lasagne. Top with another third of the vegetable mixture (don’t worry if it doesn’t cover evenly) and a second layer of lasagne.
Pour over just under half of the cheese sauce and very gently top with the remaining vegetable mixture. Finish with a final layer of lasagne and the rest of the cheese sauce. Sprinkle the reserved cheese over the top.
Bake for 35–40 minutes, or until the pasta has softened and the topping is golden brown and bubbling. Stand for 5 minutes before cutting to allow the filling to settle.

https://www.bbc.co.uk/food/recipes/best_vegetable_lasagne_50381'),
('Vegetarian Mac and Cheese',3,10,30,40,'
Preheat the oven to 200C/180C Fan/Gas 6 and grease a 35x20cm/14x8in ovenproof dish..
Melt the butter in a large saucepan over a low heat. Stir in the plain flour and cook for 1 minute. Take the pan off the heat and gradually whisk in the milk. Add the bay leaf.
Put the pan back over the heat, stirring constantly, until it boils and thickens. Take the pan off the heat again, remove the bay leaf and add the cheddar. Stir until the cheese has melted. Season with lots of black pepper and some nutmeg.
Bring a large pan of salted water to the boil and stir in the macaroni. Cook for 10 minutes, or until al dente, drain well and add to the sauce.
Take the breadcrumbs and scatter over the top. Bake for 25–30 minutes, or until golden-brown and bubbling. Serve immediately.

https://www.bbcgoodfood.com/recipes/3-veg-mac-n-cheese'),
('Italian veggie balls',4,30,60,90,'
Cooking instructions
Heat the oven to 200C/180C Fan/Gas 6. Cook the lentils in a large pan of boiling water for 20–25 minutes until soft. Drain really well, then leave sitting in the sieve to finish drying and draining for 5 minutes. Put the kettle on.
Meanwhile fry the chopped onions in the oil until soft, but not brown, for about 10 minutes. Stir in the garlic, then cook together for 2 minutes more. Scrape half of the onion mixture out of the pan and into a food processor – leave the rest in the pan for the sauce. Put the spinach in a colander and pour over the boiling water from the kettle to wilt the spinach. When cool enough to touch, squeeze as much liquid out of the spinach as you can.
Tip the cooked lentils into the food processor with the onions, then add the spinach, pesto and lemon zest. Whizz until the mixture is combined, but don’t blend to a complete mush. Pulse in the pine nuts (or almonds or oats). Scrape into a mixing bowl and combine with the egg and breadcrumbs. Season with salt and pepper and mix thoroughly. Roll into 20 balls, place on a greased baking tray and bake for 15–20 minutes, or until golden-brown and firm.
Meanwhile make the sauce. Add the tinned tomatoes, tomato purée, vinegar and sugar to the onion pan along with 500ml/18fl oz water. Stir in some basil leaves and a little salt and freshly ground black pepper to taste. Bring to a simmer and bubble for 15–18 minutes over a medium heat. Meanwhile cook the pasta according to the packet instructions.
When the meat-free balls are browned and cooked through, stir them in the sauce. Scatter with more basil leaves and serve with the spaghetti.

https://www.bbc.co.uk/food/recipes/italian_veggie_balls_67591'),
('Mushroom Wellington',6,30,90,120,'
Preheat the oven to 220C/200C Fan/Gas 7. Line a baking tray with baking paper.
Put the mushrooms in a large roasting tin, season with a pinch of salt and pepper and drizzle with olive oil. Bake for 15 minutes.
Heat a frying pan over a medium heat, add a drizzle of olive oil and as soon as it is hot, add the onions and fry for 10 minutes.
Meanwhile, put the dried apricots in a food processor, add 100ml/3½fl oz water and blend to a smooth paste. Transfer to a large mixing bowl. Put the lentils, nuts, thyme and rosemary in the food processor and process until mostly broken down. Tip the mixture into the bowl with the apricots, then add the fried onion and a pinch of salt and pepper. Stir until fully combined and the stuffing holds together.
Unroll the first sheet of pastry onto the lined baking tray and spread a third of the stuffing mixture lengthways down the middle in a strip about 5cm/2in wide, leaving 5cm/2in clear at both ends. Lay four of the mushrooms, gills facing up, on top of the stuffing and sprinkle over the garlic. Place the remaining three mushrooms on top, gills facing down.
Spoon the remaining stuffing mixture over the mushrooms, pressing it down gently to cover them on all sides. Place the second sheet of pastry over the top and press the edges together to seal (if they don\'t stick, brush the edges with a little water). Use a knife to trim around the pastry, roughly 1cm/½in away from the filling, removing any excess pastry. Gently score three lines across the top. Use a fork to crimp the edges.
Brush the pastry with olive oil and bake for 40–50 minutes, or until golden brown and cooked through.

https://www.bbc.co.uk/food/recipes/mushroom_wellington_32741'),
('Easy vegan nut roast',6,45,90,135,'
STEP 1
Combine the linseed with 4 tbsp water in a small bowl, and leave to thicken. Heat the oven to 200C/180C fan/gas 6. Toss the squash in a roasting tin with 1 tbsp olive oil, the za’atar, cumin and coriander. Cover the tin with foil and roast for 30-35 mins, or until the squash is tender but still holding its shape. Oil a 900g loaf tin and line with baking parchment.
STEP 2
Heat the remaining oil in a frying pan, and fry the onion, celery and mushrooms for 10-15 mins, or until softened. Stir in the garlic.
STEP 3
Tip the pistachios, breadcrumbs and parsley into a bowl, then stir in the linseed mixture, fried veg and roasted squash. Season well.
STEP 4
Put the cranberries in a pan with the sugar and cook for 3-4 mins, or until the sugar has dissolved and the cranberries are just starting to soften. Spoon into the base of the loaf tin, then leave to stand for 5 mins to set slightly. Top with the nut roast mixture, patting it down firmly and smoothing the top with the back of a spoon. Cover with foil and bake for 25 mins, then uncover and bake for 25 mins more. Leave to rest for 15 mins, then invert onto a serving plate, removing the parchment. Top with extra chopped pistachios and pomegranate seeds, then serve.

https://www.bbcgoodfood.com/recipes/easy-vegan-nut-roast');


INSERT INTO RecipeIngredients VALUES
(24,38,1,7),(24,32,1,1),(24,14,2,13),(24,91,0.5,1),(24,10,200,2),(24,2,200,2),(24,76,50,2),(24,59,80,2),(24,29,0.5,1),(24,23,1,12),
(25,38,1,7),(25,17,1,1),(25,21,2,15),(25,19,2,1),(25,14,2,13),(25,92,0.75,9),(25,57,0.5,9),(25,24,4.5,9),(25,93,0.25,9),(25,94,3,7),
(26,26,100,2),(26,17,1,1),(26,14,3,13),(26,23,15,2),(26,81,350,2),(26,10,400,2),(26,24,600,4),(26,95,100,2),
(27,12,400,2),(27,24,600,4),(27,96,2,7),
(28,38,3,7),(28,80,0.33,9),(28,96,1,7),
(29,73,0.5,9),(29,97,2,9),(29,98,1,9),(29,99,2,9),(29,25,1,1),(29,19,1,9),(29,100,1,9),(29,83,0.5,9),(29,101,0.25,9),(29,102,3,7),(29,38,2,7),(29,14,1,13),(29,34,0.5,7),(29,103,1,7),
(30,74,300,2),(30,103,2,7),(30,8,1,8),(30,31,1,1),(30,104,1,1),(30,25,2,1),(30,105,4,16),
(31,77,50,2),(31,106,20,2),(31,38,1,8),(31,32,0.5,1),(31,103,1,8),
(32,25,2,1),(32,28,300,2),(32,18,1,1),(32,38,3,7),(32,17,1,1),(32,14,2,13),(32,10,400,2),(32,24,200,4),(32,70,10,16),(32,93,75,2),(32,96,75,2),(32,37,750,4),(32,107,200,2),
(33,68,300,2),(33,96,40,2),(33,93,25,2),(33,37,600,4),(33,107,175,2),
(34,56,225,2),(34,17,2,1),(34,38,1,7),(34,14,4,13),(34,108,100,2),(34,109,4,7),(34,87,50,2),(34,66,300,2),(34,10,800,2),(34,103,1,8),(34,8,1,7),
(35,35,7,1),(35,38,2,7),(35,17,2,1),(35,111,160,2),(35,6,400,2),(35,87,200,2),(35,112,640,2),(35,14,4,13),
(36,113,400,2),(36,32,1,1),(36,21,1,15),(36,87,250,2),(36,14,1,13),(36,115,200,2),(36,23,0.5,12),(36,114,200,2),(36,8,4,7);



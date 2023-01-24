-- Queries for creating/populating the tables; 
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Recipes;
CREATE TABLE Recipes (
  RecipeID		int(6) NOT NULL AUTO_INCREMENT, 
  RecipeName	varchar(100) NOT NULL, 
  ShortDesc		varchar(255), 
  PrepTime		double(2,1), 
  CookTime		double(2,1), 
  TotalTime		double(2,1), 
  Servings		tinyint(2),
  Instructions	varchar(2000),
  PRIMARY KEY (RecipeID));


DROP TABLE IF EXISTS Ingredients;
CREATE TABLE Ingredients (
  IngredientID		int(6) NOT NULL AUTO_INCREMENT, 
  IngredientName	varchar(100) NOT NULL, 
  AllergenID   		int(3) NOT NULL, 
  ShopLink    		varchar(255), 
  PRIMARY KEY (IngredientID));
  
  
DROP TABLE IF EXISTS Allergens;
CREATE TABLE Allergens (
  AllergenID        int(3) NOT NULL AUTO_INCREMENT, 
  AllergenName   	varchar(100) NOT NULL, 
  ShortDesc    		varchar(255), 
  PRIMARY KEY (AllergenID));

DROP TABLE IF EXISTS RecipeIngredients;
CREATE TABLE RecipeIngredients (
  RecipeID		int(6) NOT NULL, 
  IngredientID	int(6) NOT NULL, 
  Quantity		double(4,1) NOT NULL,
  Measurement	varchar(30),
  PRIMARY KEY (RecipeID, IngredientID));


ALTER TABLE Ingredients ADD CONSTRAINT AllergenKey FOREIGN KEY (AllergenID) REFERENCES Allergens (AllergenID);

ALTER TABLE RecipeIngredients ADD CONSTRAINT RecipeKey FOREIGN KEY (RecipeID) REFERENCES Recipes (RecipeID);
ALTER TABLE RecipeIngredients ADD CONSTRAINT IngredientKey FOREIGN KEY (IngredientID) REFERENCES Ingredients (IngredientID);


SET FOREIGN_KEY_CHECKS=1;

INSERT INTO Allergens(AllergenName) VALUES
('None'),('Nuts'),('Sesame'),('Soya'),('Legumes'),('Celery'),('Gluten'),('Sugar'),('Citrus'),('Milk'),('Eggs');


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
('Sweet Potato and Chick Pea Curry', 4,  '2 – 4 cloves of garlic
3 tbsp curry paste
2 tsp Curry powder
2 Onions 2 sweet potatoes 3 carrots
300g Chick peas
1 Can coconut milk
400g Rice
- Soak chickpeas for 4 – 8hours (we just leave them overnight), rinse then place in a pot of
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
('Minestrone Soup', 5, '1 can of Cannellini Beans
2 Onions
2 – 4 cloves garlic finely chopped
4 sticks celery, 2 carrots, 2 potato diced
1 can chopped tomatoes
1 bunch fresh parsley
500ml Veg stock
150 g Orzo
- Chop all of your vegetables and strain the cannellini beans
- In a large pot fry onions and garlic until softened
- Add celery, carrots and potatoes and cook for 2 – 3 minutes
- Add cannellini beans and parsley and cover with veg stock until everything is just covered
- Add can of tomatoes and simmer for 45 mins – an hour
- Cook the orzo in a separate pot, strain and add to the soup
- Serve and enjoy'),
('Paella with Spanish Salad',4, 'Paella:
400 g Arborio rice
4 cloves garlic, 2 peppers, 4 tomato, 2 onions
2 -3 tsp smoked paprika, 1 tsp garlic salt, 2tsp kibbled onions
800ml Vegetable stock
Salad:
Tomato, courgette, red onion
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
('Thai Green Lentil and Vegetable Curry', 2, '2 – 4 cloves of garlic
2 tbsp curry paste
1 piece fresh ginger
200g Green lentils (Soak lentils for 1 hour before hand to reduce cooking time)
1 onion, 1 pepper, 1 courgette
1 lime, chilli
Can coconut milk
200g Rice
- Peel and chop your garlic, chilli, ginger and veg
- Fry onions, chilli, ginger and garlic in oil for 2 mins. Add the curry paste and cook for
another 2 mins stirring often
- strain and add in the green lentils and coconut milk, bring to boil and simmer for 15 mins
(a little more if you did not soak lentils)
- Add vegetables and simmer for another 5 minutes until everything is tender. Remove from
heat and add a squeeze of lime to taste
- Boil noodles or rice in water, drain and serve'),
('Cajun Chick Pea Burgers with Wedges', 2, 'Burgers:
2 – 4 cloves Garlic
1 Onion, 1Carrot, 1Courgette
200 g Chickpeas
1 tsp Cajun spice
½ tsp Garlic Salt
Wedges:
Potato
1 tsps smoked paprika
1 tsp cumin
1 tsp garlic salt
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
('Falafel Burgers with Guac and salad', 2, 'Burgers:
200g Falafel mix
water
2 rolls
Guac:
1 Avocado, 1/2 red onion finely chopped
2 cloves garlic finely chopped
1 Lime, ½ Chilli,
60 g cherry tomatoes quartered
Salad:
½ chilli
1 Courgette
1 Red onion
200 g Cherry tomatoes
Carrot
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
('Ramen Noodle Bowl', 4, '2 cm piece fresh ginger, 1 Chilli
2 – cloves garlic
Soy Sauce
1 Onion
2 Carrots
small bunch of spring onions
6 fresh mushrooms
40 g dried mixed mushrooms
1 litre vegetable stock (2 tsp veg stock powder and 1 litre water)
2 nests of Noodles
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
('Pancakes', 2, '2 cups self raising flour
1 cup sugar
1 tsp baking powder
400ml milk
1tbsp oil
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
('Bread Salad', 4, '1 loaf French cobb
200g Heritage Tomatoes
200g cherry tomatoes
2 red onions
1 courgette
2 – 4 cloves Garlic
Rapeseed oil
- Roughly cut your loaf of bread into cubes about 2cm big
- Heat some oil in a frying pan and in batches lightly fry the chunks of bread then set aside
- Finely chop the garlic and onions
- Half the cherry tomatoes and chop the heritage tomatoes into chunks
- Cut the courgette in half lengthways then slice each half up
- Combine all of the vegetables and the fried bread in a bowl, add 2 tbsp oil and salt and
pepper to taste
- Serve and enjoy');

INSERT INTO RecipeIngredients VALUES
(1,14,2,'clove(s)'),(1,15,3,'tbsp'),(1,16,2,'tsp'),(1,17,2,''),(1,18,2,''),(1,19,3,''),(1,2,300,'g'),(1,20,1,'can(s)'),(1,1,400,'g'),
(2,3,1,'can(s)'),(2,17,2,''),(2,14,2,'clove(s)'),(2,21,4,'stick(s)'),(2,19,2,''),(2,22,2,''),(2,23,1,'bunch(es)'),(2,24,500,'ml'),(2,4,150,'g'),
(3,5,400,'g'),(3,14,4,'clove(s)'),(3,25,2,''),(3,26,4,''),(3,17,2,''),(3,24,800,'ml'),(3,28,1,''),(3,32,1,''),(3,39,2,'tbsp'),
(4,14,2,'clove(s)'),(4,15,2,'tbsp'),(4,27,1,'piece(s)'),(4,6,200,'g'),(4,17,1,''),(4,25,1,''),(4,28,1,''),(4,29,1,''),(4,20,1,'can(s)'),(4,1,200,'g'),
(5,14,2,'clove(s)'),(5,17,1,''),(5,19,1,''),(5,28,1,''),(5,2,200,'g'),(5,22,1,''),
(6,30,200,'g'),(6,31,1,''),(6,32,0.5,''),(6,29,1,''),(6,14,2,'clove(s)'),(6,33,60,'g'),(6,28,1,''),(6,19,1,''),
(7,27,1,'2cm piece(s)'),(7,14,2,'clove(s)'),(7,34,1,'tsp to taste'),(7,17,1,''),(7,19,1,''),(7,35,6,''),(7,24,1,'l'),(7,7,2,'nest(s)'),
(8,36,2,'cup(s)'),(8,8,1,'cup(s)'),(8,9,1,'tbsp'),(8,37,400,'ml'),(8,38,1,'tbsp'),
(9,10,1,'can(s)'),(9,17,2,''),(9,25,2,''),(9,11,200,'g'),(9,2,60,'g'),(9,39,1,'tsp'),(9,14,2,'clove(s)'),(9,12,500,'g'),
(10,13,1,'loaf(s)'),(10,26,200,'g'),(10,33,200,'g'),(10,32,2,''),(10,28,1,''),(10,38,1,'tsp'),(10,14,2,'clove(s)');


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

-- tests

-- SELECT RecipeName FROM RecipeIngredients JOIN Recipes ON Recipes.RecipeID = RecipeIngredients.RecipeID WHERE IngredientID = 28 ;

-- SELECT RecipeName,Recipes.RecipeID FROM Recipes JOIN
-- 	(SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 28
-- 	INTERSECT
-- 	SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 32
-- 	INTERSECT 
-- 	SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 33) r 
-- ON Recipes.RecipeID=r.RecipeID;

-- SELECT RecipeID FROM RecipeIngredients JOIN
-- 	(SELECT IngredientID FROM Ingredients WHERE AllergenID = 4
--     UNION
-- 	SELECT IngredientID FROM Ingredients WHERE AllergenID = 7) a
-- ON RecipeIngredients.IngredientID=a.IngredientID;
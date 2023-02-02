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
  Instructions  varchar(2000),
  PRIMARY KEY (RecipeID));

DROP TABLE IF EXISTS Ingredients;
CREATE TABLE Ingredients (
  IngredientID    int(6) NOT NULL AUTO_INCREMENT, 
  IngredientName  varchar(100) NOT NULL, 
  AllergenID      int(3) NOT NULL, 
  ShopLink        varchar(255), 
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

INSERT INTO Recipes(RecipeName, Servings, PrepTime, CookTime, TotalTime, Instructions) VALUES
('Cauliflower and chickpea stew',1,30,30,60,'•  1 tbsp olive oil 
• 1 red onion, thinly sliced
• 2 garlic cloves, finely chopped or grated
• 1–2 tsp ground cumin, or to taste
• ½ tsp chilli flakes 
• ½ cauliflower, broken down into florets 
• 200g/7oz tinned chopped tomatoes (see recipe tips)
• 200g/7oz cooked chickpeas (see recipe tips)(or any pulse)
• 50g/1¾oz long-grain rice 
• 80g/2¾oz frozen peas
• ½ lime, juice only
• small handful fresh flatleaf parsley, finely chopped 
• salt and ground black pepper 
Cooking instructions
1.  Heat the oil in a saucepan or frying pan. Add the onion and sweat over a low heat for 5 minutes until softening. Add the garlic and spices and cook for 1 minute until fragrant. 
2.  Add the cauliflower, tomatoes, chickpeas and the liquid from the tin and cook on a low simmer for 15 minutes until the cauliflower is tender. 
3.  Meanwhile, rinse the rice and cook according to packet instructions. 
4.  Add the peas to the cauliflower mixture and cook for 2 minutes. Season with the lime juice, salt and pepper. Stir through most of the parsley and serve with the rice.

https://www.bbc.co.uk/food/recipes/cauliflower_and_chickpea_82819'),
('Millet & Black Lentil Stuffed Delicata Squash',8,15,45,60,'4 average size delicata squash about 10-12 ounces each, split in half lengthwise and seeds removed
1 tablespoon olive oil
1 small white or yellow onion chopped
2 stalks celery chopped
2 carrots peeled and chopped
2 cloves garlic minced
3/4 cup millet
1/2 cup black lentils
3/4 teaspoon sea salt
3 cups low sodium vegetable broth
Black pepper to taste
FOR THE GRAVY (MAKES 1 1/2 CUPS)
1/4 cup unbleached all-purpose flour (substitute chickpea flour for a gluten free version)
3 tablespoons nutritional yeast flakes
1 1/2 cups low-sodium vegetable broth
2 tablespoons tamari
2 teaspoons olive oil
1/2 teaspoon dried thyme crushed
1/2 teaspoon garlic powder
Black pepper to taste

Cooking instructions
Preheat your oven to 400F and line two baking sheets with parchment or foil. Spray or brush both sides of the squash with oil. Place the squash, cut side down, on the baking sheets. Roast for 25-35 minutes, or until the squash are fork tender and browning.
While the squash halves roast, heat the oil in a medium sized pot. Add the onion, celery, and carrots. Cook, stirring every now and then, for 5-7 minutes, or until the onion is soft and clear. Add the garlic and millet. Toast the millet for about 2 minutes, or until it smells a bit nutty. Add the salt and broth. Bring the millet to a boil, reduce the heat to low, cover, and simmer for 20-25 minutes, or until the lentils are tender (but a little al dente) and the millet has absorbed all of the liquid. Remove the millet from heat and allow it to steam while you make the gravy.
To prepare the gravy, heat the flour and nutritional yeast in a small saucepan over medium heat. Stir them frequently, and continue cooking until they smell toasted and the flour is just golden (about 5 minutes). Remove them from heat and whisk in the vegetable broth, tamari, olive oil, thyme, and garlic powder. Return the mixture to low heat and cook, whisking constantly, until the gravy is thick and bubbly. Season to taste with black pepper and remove from heat.
When the squash halves are ready, flip them over. Taste the millet and black lentil stuffing and adjust salt and pepper as needed. Stuff each squash half with the stuffing, then top with the gravy (or another sauce or dressing). Serve.
Notes:
Millet and black lentil stuffing can be prepared a day in advance, and the squashes can be roasted a day in advance. Gravy can be prepared up to 2 days in advance, or frozen for up to 3 weeks.

https://www.thefullhelping.com/millet-black-lentil-stuffed-delicata-squash'),
('Pearl barley and tomato risotto recipe',4,10,40,50,'100g sundried tomatoes (drained weight), finely chopped, plus 1 tbsp oil from the jar
1 onion, finely chopped
3 garlic cloves, crushed
15g fresh parsley, stems finely chopped, leaves roughly chopped
350g pearl barley
400g tin chopped tomatoes
1 reduced-salt vegetable stock cube, made up to 600ml
100g Greek-style salad cheese, crumbled
Cooking instructions
Heat the 1 tbsp oil from the tomato jar in a large, lidded saucepan over a medium-low heat. Add the onion, garlic and parsley stems and cook, stirring occasionally, for 5-7 mins until soft and translucent. Stir in the pearl barley, sundried tomatoes, chopped tomatoes and stock.
Bring to the boil, then cover and reduce the heat to low. Simmer for 30-40 mins, stirring occasionally, until the barley is just cooked and all the liquid has been absorbed.
Give the barley a good stir until it’s released its starch and the risotto is creamy; season with pepper. Stir in the cheese and parsley leaves to serve.
Tip: To make it vegan, use a stock pot instead of a cube and swap the feta for 2 tbsp nutritional yeast.

https://realfood.tesco.com/recipes/pearl-barley-and-tomato-risotto.html'),
('Pearl Couscous',6,5,15,20,'400 g pearl couscous
600 ml vegetable broth
2 tb spoons butter
Cooking instructions
Step 1: Melt butter in a preheated saucepan over medium high heat.
Step 2: Add couscous and sauté until nice and golden, stirring frequently, 3-5 minutes.
TIP: Make sure to stir couscous frequently, while toasting to avoid burning.
Step 3: Add broth and bring it to a simmer.
Step 4: Reduce heat to simmer and cover the pot. Continue to cook for about 10 minutes, or until the liquid is absorbed and couscous is soft.

https://www.busycooks.net/how-to-cook-pearl-couscous/'),
('Popcorn',4,0,10,10,'3 Tbsp Coconut Oil
1/3 Cup of high quality popcorn kernels
1 Tbsp of butter
Salt to taste
Cooking instructions
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
('Thai quinoa salad', 4,35,15,50,'Salad
1/2 cup uncooked white quinoa
2 cups kale
1 cup edamame 
2 cups coleslaw mix (or shredded cabbage)
1 red pepper coarsely chopped
1 cup matchstick (or shredded) carrots
1 cup coarsely chopped mango 
1/2 cup coarsely chopped cilantro (~1/2 bunch)
1/4 cup thinly sliced green onions (~3-4 onions)
1/2 cup cashews coarsely chopped roasted and lightly salted
Dressing
1/4 cup creamy peanut butter
3 tablespoons honey
2 tablespoons olive oil
2 tablespoons hot water
1 clove garlic coarsely chopped
1 and 1/2 tablespoons EACH: rice vinegar and low sodium soy sauce
Fine sea salt and freshly cracked pepper

Cooking instructions
QUINOA: Prepare the quinoa by rinsing it under cold water in a fine mesh sieve to remove the bitter saponin coating. Combine the quinoa and 1 cup water in a small pot over high heat. Bring to a boil, add in 1/2 teaspoon fine sea salt (or to taste), reduce the heat to low, and cover the pot. Simmer for 10-15 minutes or until the liquid is absorbed. Remove from heat, keep the quinoa covered, and let stand for 10-15 minutes. Fluff with a fork and place in the fridge or freezer to cool to room temperature.
EDAMAME: Meanwhile, bring a pot with 6 cups of water to a boil, then add in 1 tablespoon fine sea salt, and the 1 cup of frozen and shelled edamame. Cook for 2-3 minutes or until edamame is tender. Drain thoroughly.
KALE: Remove the thick stems and then very thinly slice (ribbon) the kale. The smaller the shreds of kale, the better! Once it\'s all chopped, put it in a colander (or the base of a salad spinner) and give it a quick rinse. Rub and massage the kale for about a minute and then give it another quick rinse. Allow the kale to dry completely before using in the salad or spin in the salad spinner to dry it quickly.
VEGGIE/FRUIT PREP: Thinly slice the cabbage or measure out 2 cups of coleslaw mix. Coarsely chop the red pepper, mango, cilantro (and then loosely measure to get 1/2 cup) and the cashews. Thinly slice the green onions.
DRESSING: Place 1/4 cup creamy peanut butter, 3 tablespoons honey, 2 tablespoons olive oil, 2 tablespoons hot water, coarsely chopped garlic clove, 1 and 1/2 tablespoons rice vinegar, 1 and 1/2 tablespoons low sodium soy sauce, 1/8 teaspoon pepper, and 1/4 teaspoon salt in a small blender jar. Process until smooth and refrigerate while preparing everything else.
SALAD ASSEMBLY: Combine the cooked and completely cooled quinoa, shredded kale, coleslaw/cabbage, red pepper, carrots, mango, cilantro, green onions, and cashews in a large bowl. Drizzle with dressing (to desired preference; we use all the dressing, but you may prefer less; see instruction #7). Toss to combine and enjoy!
STORAGE: This salad doesn\'t sit well with the dressing, so only dress what will be enjoyed the same day. Store any leftover salad and dressing separately.

https://www.chelseasmessyapron.com/thai-quinoa-salad/'),
('Vegan Sushi',2,20,10,30,'300g sushi rice
2 tbsp rice or white wine vinegar
1 tsp caster sugar
1 large avocado
juice ½ lemon
cucumber strips
2 red peppers
4 sheets nori seaweed
1 bunch chives
sweet soy sauce (kecap manis), to serve


Cooking instructions
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
('Bulgar wheat salad',1,5,15,20,'50g  bulgar wheat
20g  sultanas
a pinch  saffron
oil
1 tsp pomegranate molasses, plus more to serve 
½ small red onion, finely diced
1 tbsp flaked almonds, toasted 
1 tsp red wine vinegar
a handful  rocket

Cooking instructions

STEP 1
Heat the oven to 200C/fan 180C/gas 6. Cover the bulgar wheat with boiling water, cover with clingfilm and leave to absorb for 10-15 minutes. Drain well. Pour 1 tbsp hot water from a kettle over the sultanas and saffron in a small bowl.

STEP 2
Toss the red onion, flaked almonds, red wine vinegar and bulgar, and season. Add the sultanas and their juice and season well. Toss the rocket with the salad, and serve with the sliced chicken. Drizzle with more pomegranate molasses.

https://www.olivemagazine.com/recipes/healthy/pomegranate-roasted-chicken-with-bulgar-wheat-salad/'),
('Vegetarian lasagne',6,30,90,120,'2 yellow or red peppers, seeds removed, cut into roughly 2cm/¾in chunks
1 courgette, about 300g/10½oz, quartered lengthways and cut into roughly 2cm/¾in chunks
1 large sweet potato, peeled and cut into roughly 2cm/¾in chunks
3 tbsp extra virgin olive oil
1 large onion, finely chopped
½ tsp dried chilli flakes
2 garlic cloves, crushed
2 x 400g tins chopped tomatoes
2 tsp Italian seasoning or dried oregano
1 vegetable stock cube
200ml/7fl oz cold water
100g/3½oz young spinach leaves (optional)
9 –10 dried lasagne sheets
salt and freshly ground black pepper
For the cheese sauce
75g/2½oz plain flour
75g/2½oz butter, cubed
750ml/1¼ pint milk, semi-skimmed or full-fat
125g/4½oz mature cheddar, coarsely grated
75g/2½oz grated mozzarella, or extra cheddar

Cooking instructions
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
('Vegetarian Mac and Cheese',3,10,30,40,'300g penne, macaroni or any short pasta  (we used Napolina 50% white 50% wholemeal)
40g butter
1 tsp Dijon mustard
25g flour
600ml milk
175g mature Cheddar cheese (we used a vegetarian version)
27 grams of breadcrumbs
Cooking Instructions

Preheat the oven to 200C/180C Fan/Gas 6 and grease a 35x20cm/14x8in ovenproof dish..
Melt the butter in a large saucepan over a low heat. Stir in the plain flour and cook for 1 minute. Take the pan off the heat and gradually whisk in the milk. Add the bay leaf.
Put the pan back over the heat, stirring constantly, until it boils and thickens. Take the pan off the heat again, remove the bay leaf and add the cheddar. Stir until the cheese has melted. Season with lots of black pepper and some nutmeg.
Bring a large pan of salted water to the boil and stir in the macaroni. Cook for 10 minutes, or until al dente, drain well and add to the sauce.
Take the breadcrumbs and scatter over the top. Bake for 25–30 minutes, or until golden-brown and bubbling. Serve immediately.

https://www.bbcgoodfood.com/recipes/3-veg-mac-n-cheese'),
('Italian veggie balls',4,30,60,90,'For the meatballs
225g/8oz dried brown lentils
2 brown onions, finely chopped
1 tbsp olive oil, plus a tsp extra for greasing
4 garlic cloves, crushed
100g/3½oz baby spinach
4 tbsp readymade basil pesto
1 lemon, zest only
50g/1¾oz pine nuts, toasted (alternatively use finely chopped almonds or, for a nut-free alternative, the same quantity of whole oats)
1 large free-range egg
50g/1¾oz fresh breadcrumbs (wholemeal or white)
300g/10½oz dried spaghetti (or linguine, tagliatelle etc.)
For the tomato sauce
2 x 400g tins chopped tomatoes
2 tbsp tomato purée
1 tsp red wine vinegar
1 tbsp granulated or caster sugar
few basil leaves, plus extra to serve
salt and freshly ground black pepper


Cooking instructions
Heat the oven to 200C/180C Fan/Gas 6. Cook the lentils in a large pan of boiling water for 20–25 minutes until soft. Drain really well, then leave sitting in the sieve to finish drying and draining for 5 minutes. Put the kettle on.
Meanwhile fry the chopped onions in the oil until soft, but not brown, for about 10 minutes. Stir in the garlic, then cook together for 2 minutes more. Scrape half of the onion mixture out of the pan and into a food processor – leave the rest in the pan for the sauce. Put the spinach in a colander and pour over the boiling water from the kettle to wilt the spinach. When cool enough to touch, squeeze as much liquid out of the spinach as you can.
Tip the cooked lentils into the food processor with the onions, then add the spinach, pesto and lemon zest. Whizz until the mixture is combined, but don’t blend to a complete mush. Pulse in the pine nuts (or almonds or oats). Scrape into a mixing bowl and combine with the egg and breadcrumbs. Season with salt and pepper and mix thoroughly. Roll into 20 balls, place on a greased baking tray and bake for 15–20 minutes, or until golden-brown and firm.
Meanwhile make the sauce. Add the tinned tomatoes, tomato purée, vinegar and sugar to the onion pan along with 500ml/18fl oz water. Stir in some basil leaves and a little salt and freshly ground black pepper to taste. Bring to a simmer and bubble for 15–18 minutes over a medium heat. Meanwhile cook the pasta according to the packet instructions.
When the meat-free balls are browned and cooked through, stir them in the sauce. Scatter with more basil leaves and serve with the spaghetti.

https://www.bbc.co.uk/food/recipes/italian_veggie_balls_67591'),
('Mushroom Wellington',6,30,90,120,'7 large flat or portobello mushrooms
2–3 tbsp olive oil
2 brown onions, finely chopped
160g/5¾oz dried apricots
400g tin green lentils, drained and rinsed
200g/7oz mixed nuts (such as walnuts, pecans and almonds)
4 sprigs fresh thyme, leaves picked
3 sprigs fresh rosemary, leaves picked
2 x 320g packs ready-rolled vegan puff pastry
4 garlic cloves, finely chopped
salt and freshly ground black pepper

Cooking instructions
Preheat the oven to 220C/200C Fan/Gas 7. Line a baking tray with baking paper.
Put the mushrooms in a large roasting tin, season with a pinch of salt and pepper and drizzle with olive oil. Bake for 15 minutes.
Heat a frying pan over a medium heat, add a drizzle of olive oil and as soon as it is hot, add the onions and fry for 10 minutes.
Meanwhile, put the dried apricots in a food processor, add 100ml/3½fl oz water and blend to a smooth paste. Transfer to a large mixing bowl. Put the lentils, nuts, thyme and rosemary in the food processor and process until mostly broken down. Tip the mixture into the bowl with the apricots, then add the fried onion and a pinch of salt and pepper. Stir until fully combined and the stuffing holds together.
Unroll the first sheet of pastry onto the lined baking tray and spread a third of the stuffing mixture lengthways down the middle in a strip about 5cm/2in wide, leaving 5cm/2in clear at both ends. Lay four of the mushrooms, gills facing up, on top of the stuffing and sprinkle over the garlic. Place the remaining three mushrooms on top, gills facing down.
Spoon the remaining stuffing mixture over the mushrooms, pressing it down gently to cover them on all sides. Place the second sheet of pastry over the top and press the edges together to seal (if they don\'t stick, brush the edges with a little water). Use a knife to trim around the pastry, roughly 1cm/½in away from the filling, removing any excess pastry. Gently score three lines across the top. Use a fork to crimp the edges.
Brush the pastry with olive oil and bake for 40–50 minutes, or until golden brown and cooked through.

https://www.bbc.co.uk/food/recipes/mushroom_wellington_32741'),
('Easy vegan nut roast',6,45,90,135,'2 tbsp milled linseed
400g butternut squash peeled, deseeded and cut into 3cm chunks
3 tbsp olive oil, plus extra for the tin
2 tbsp za’atar
2 tsp ground cumin
2 tbsp ground coriander
1 red onion, finely chopped
1 celery stick, finely chopped
250g chestnut mushrooms, finely chopped
1 garlic clove, crushed
200g pistachios roughly chopped, plus extra to serve
100g fresh breadcrumbs
½ small bunch of parsley, finely chopped
200g fresh or frozen cranberries
4 tbsp light brown soft sugar
pomegranate seeds, to serve
Cooking instructions


STEP 1
Combine the linseed with 4 tbsp water in a small bowl, and leave to thicken. Heat the oven to 200C/180C fan/gas 6. Toss the squash in a roasting tin with 1 tbsp olive oil, the za’atar, cumin and coriander. Cover the tin with foil and roast for 30-35 mins, or until the squash is tender but still holding its shape. Oil a 900g loaf tin and line with baking parchment.
STEP 2
Heat the remaining oil in a frying pan, and fry the onion, celery and mushrooms for 10-15 mins, or until softened. Stir in the garlic.
STEP 3
Tip the pistachios, breadcrumbs and parsley into a bowl, then stir in the linseed mixture, fried veg and roasted squash. Season well.
STEP 4
Put the cranberries in a pan with the sugar and cook for 3-4 mins, or until the sugar has dissolved and the cranberries are just starting to soften. Spoon into the base of the loaf tin, then leave to stand for 5 mins to set slightly. Top with the nut roast mixture, patting it down firmly and smoothing the top with the back of a spoon. Cover with foil and bake for 25 mins, then uncover and bake for 25 mins more. Leave to rest for 15 mins, then invert onto a serving plate, removing the parchment. Top with extra chopped pistachios and pomegranate seeds, then serve.

https://www.bbcgoodfood.com/recipes/easy-vegan-nut-roast');

INSERT INTO Ingredients(IngredientName,AllergenID) VALUES 
('cauliflower',1),
('millet',1),
('all-purpose flour',7),
('yeast flakes',1),
('salad cheese',10),
('butter',10),
('kale',1),
('edamame',4),
('cabbage',1),
('mango',1),
('peanut butter',2),
('honey',1),
('vinegar',1),
('cucumber',1),
('nori',1),
('sultanas',1),
('cheddar',10),
('spinach',1),
('pesto',2),
('egg',11),
('dried apricots',1),
('puff pastry',7),
('butternut squash',1),
('cranberries',1),
('pistachios',2);

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

-- tests

-- SELECT RecipeName FROM RecipeIngredients JOIN Recipes ON Recipes.RecipeID = RecipeIngredients.RecipeID WHERE IngredientID = 28 ;

-- SELECT RecipeName,Recipes.RecipeID FROM Recipes JOIN
--  (SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 28
--  INTERSECT
--  SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 32
--  INTERSECT 
--  SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = 33) r 
-- ON Recipes.RecipeID=r.RecipeID;

-- SELECT RecipeID FROM RecipeIngredients JOIN
--  (SELECT IngredientID FROM Ingredients WHERE AllergenID = 4
--     UNION
--  SELECT IngredientID FROM Ingredients WHERE AllergenID = 7) a
-- ON RecipeIngredients.IngredientID=a.IngredientID;
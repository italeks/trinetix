/* нода и все чайлд : нода с ID=7*/
SELECT id, NAME, LEVEL FROM items_tree WHERE left_key >= 24 AND right_key <= 31 ORDER BY left_key;

/*добавление нод : нода с ID=16*/
UPDATE items_tree 
	SET left_key = left_key + 2, right_key = right_key + 2 
	WHERE left_key > 29
	
UPDATE items_tree 
	SET right_key = right_key + 2 
	WHERE right_key >= 29 AND left_key < 29;
		
INSERT INTO items_tree 
	SET left_key = 29, right_key = 29 + 1, LEVEL = 4 + 1 ;

/*удалить ноду и ее чайлдов*/
DELETE FROM items_tree 
	WHERE left_key >= 29 AND right_key <= 30;
		
UPDATE items_tree 
	SET right_key = right_key -(30 - 29 + 1) 
	WHERE right_key > 30 AND left_key < 29;
	
UPDATE items_tree 
	SET left_key = left_key - (30 - 29 + 1), right_key = right_key - (30 - 29 + 1) 
	WHERE left_key > 30;
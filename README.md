# Pol emploie

## 1. configuration de la bdd : 
la bdd 'login' contient 4 tables :

```
+-----------------+
| Tables_in_login |
+-----------------+
| admins          |
| companies       |
| offres          |
| users           |
+-----------------+
```

- la table admin
    - elle contient les comptes administrateurs du site



```
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int          | NO   | PRI | NULL    | auto_increment |
| username | varchar(50)  | NO   | UNI | NULL    |                |
| password | varchar(255) | NO   |     | NULL    |                |
| email    | varchar(50)  | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
```

- la table companies 
    - elle contient les comptes entreprises du site

```
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int          | NO   | PRI | NULL    | auto_increment |
| username | varchar(50)  | NO   | UNI | NULL    |                |
| password | varchar(255) | NO   |     | NULL    |                |
| email    | varchar(50)  | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+

```

- la table offres 
    - elle contient les offres émisent par les entreprises 

```
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int          | NO   | PRI | NULL    | auto_increment |
| title       | varchar(20)  | YES  |     | NULL    |                |
| entreprise  | varchar(20)  | YES  |     | NULL    |                |
| description | varchar(255) | YES  |     | NULL    |                |
| email       | char(50)     | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
```

- la tables users
    - elle contient les comptes utilisateurs du site

```
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int          | NO   | PRI | NULL    | auto_increment |
| username | varchar(50)  | NO   | UNI | NULL    |                |
| password | varchar(255) | NO   |     | NULL    |                |
| email    | varchar(50)  | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+

```

## 2. comptes 

aucun compte ne seras crée a part un compte admin.

```
username : admin
password : root
```




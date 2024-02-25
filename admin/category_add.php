<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];

		// Generate a slug from the category name
		$slug = strtolower(str_replace(' ', '-', $name));

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Category already exists';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO category (name, cat_slug) VALUES (:name, :slug)");
				$stmt->execute(['name'=>$name, 'slug'=>$slug]);
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: category.php');
?>

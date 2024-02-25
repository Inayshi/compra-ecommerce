<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	if(isset($_POST['edit'])){
		$curr_password = $_POST['curr_password'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$address2 = $_POST['address2'];
		$address3 = $_POST['address3'];
		$buyer2 = $_POST['buyer2'];
		$buyer3 = $_POST['buyer3'];
		$contact_info2 = $_POST['contact_info2'];
		$contact_info3 = $_POST['contact_info3'];

		$photo = $_FILES['photo']['name'];
		if(password_verify($curr_password, $user['password'])){
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $user['photo'];
			}

			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			try {
				$stmt = $conn->prepare("UPDATE users SET 
					email=:email, 
					password=:password, 
					firstname=:firstname, 
					lastname=:lastname, 
					contact_info=:contact, 
					address=:address, 
					address2=:address2, 
					address3=:address3, 
					buyer2=:buyer2, 
					buyer3=:buyer3, 
					contact_info2=:contact_info2, 
					contact_info3=:contact_info3, 
					photo=:photo 
					WHERE id=:id");
				$stmt->execute([
					'email' => $email,
					'password' => $password,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'contact' => $contact,
					'address' => $address,
					'address2' => $address2,
					'address3' => $address3,
					'buyer2' => $buyer2,
					'buyer3' => $buyer3,
					'contact_info2' => $contact_info2,
					'contact_info3' => $contact_info3,
					'photo' => $filename,
					'id' => $user['id']
				]);

				$_SESSION['success'] = 'Account updated successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
			
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	$pdo->close();

	header('location: profile.php');
?>

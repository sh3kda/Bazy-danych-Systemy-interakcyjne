<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Zajecia PHP - 1 </title>

            <style>
                table {
                    border-collapse: collapse;
                    border: 1px solid black;
                    text-align: center;
                    padding: 5px;
                    background-color: #f2f2f2;
                }
                td {
                    padding: 5px;
                    border: 1px solid black;
                    text-align: center;
                }
                th {
                    padding: 5px;
                    border: 1px solid black;
                    text-align: center;
                    font-weight: bold;
                }

            </style>
    </head>
    
    <body>
        <?php
		
		/*      tutaj probowalismy error handlingu

				ini_set('display_errors',1);
				ini_set('display_startup_error',1);
				error_reporting (E_ALL);
				alt. error_reporting (0);
        */
		
        include 'autoryzacja.php';
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        
        if (!$conn) {
            echo "Blad polaczenia: ".mysqli_connect_error();
            exit();
        }else{
			echo "Polaczenie udane! <br><br> 
			Teraz wyswietle graczy z bazy danych: <br>";}
        
        $result = mysqli_query($conn, "SELECT * FROM gracze");

        if ($result) {
			
			echo '<table border =1>'; 
			
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>'.$row['imie'].'</td>'.'<td>'. $row['nazwisko'].'</td>';
                echo '</tr>';
            }
        } else {
            echo "Błąd zapytania: ".mysqli_error($conn);
        }
        
        ?>
    </body>
</html>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Gry komputerowe</title>
<link rel="stylesheet" href="styl.css">
</head>

<body>

<header>
<h1>Ranking gier komputerowych</h1>
</header>

<section id="lewa">
<h3>Top 5 gier w tym miesiącu</h3>

<ul>
<?php
$conn = mysqli_connect("localhost","root","","gry");
$sql = "SELECT nazwa, punkty FROM gry ORDER BY punkty DESC LIMIT 5";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res)){
    echo "<li>".$row['nazwa']." <span class='punkty'>".$row['punkty']."</span></li>";
}
?>
</ul>

<h3>Nasz sklep</h3>
<a href="http://sklep.gry.pl">Tu kupisz gry</a>

<h3>Stronę wykonał</h3>
<p>12345</p>
</section>

<section id="srodek">
<?php
$sql = "SELECT id, nazwa, zdjecie FROM gry";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res)){
    echo "<div class='gra'>";
    echo "<img src='".$row['zdjecie']."' alt='".$row['nazwa']."' title='".$row['id']."'>";
    echo "<p>".$row['nazwa']."</p>";
    echo "</div>";
}
?>
</section>

<section id="prawa">
<h3>Dodaj nową grę</h3>

<form method="POST">
<label>Nazwa</label><input name="nazwa"><br>
<label>Opis</label><input name="opis"><br>
<label>Cena</label><input name="cena"><br>
<label>Zdjęcie</label><input name="zdjecie"><br>
<button type="submit">DODAJ</button>
</form>

<?php
if(isset($_POST['nazwa'])){
    $n = $_POST['nazwa'];
    $o = $_POST['opis'];
    $c = $_POST['cena'];
    $z = $_POST['zdjecie'];

    $sql = "INSERT INTO gry (nazwa, opis, punkty, cena, zdjecie)
    VALUES ('$n','$o',0,$c,'$z')";
    mysqli_query($conn,$sql);
}
?>
</section>

<footer>
<form method="POST">
<input name="id">
<button type="submit">Pokaż opis</button>
</form>

<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = "SELECT nazwa, LEFT(opis,100) as opis, punkty, cena FROM gry WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);

    echo "<h2>".$row['nazwa'].", ".$row['punkty']." punktów, ".$row['cena']." zł</h2>";
    echo "<p>".$row['opis']."</p>";
}

mysqli_close($conn);
?>
</footer>

</body>
</html>
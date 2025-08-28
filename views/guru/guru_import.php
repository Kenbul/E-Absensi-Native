<!DOCTYPE html>
<html>

<head>
    <title>Import Guru</title>
</head>

<body>
    <h2>Import Data Guru dari CSV</h2>
    <form action="index.php?page=guru&action=import_data" method="POST" enctype="multipart/form-data">
        <label>Pilih file CSV:</label><br>
        <input type="file" name="file" required><br><br>
        <button type="submit" name="submit">Import</button>
    </form>
</body>

</html>
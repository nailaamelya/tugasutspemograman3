<!DOCTYPE html>
<html>
<head>
    <title>Hasil Transaksi</title>
</head>
<body>
    <h1>HASIL TRANSAKSI</h1>
    <table border="1">
        <tr>
            <th>Nama Member</th>
            <th>Level</th>
            <th>Diskon Member</th>
            <th>Diskon Barang</th>
            <th>Total Pembelian</th>
            <th>Total Diskon</th>
            <th>Total Transaksi</th>
        </tr>
        <?php
        include 'koneksi.php';

        $query = "SELECT 
            m.nama_member AS member,
            m.level AS level,
            CONCAT(
                CASE 
                WHEN m.level = 'Platinum' THEN '15%'
                WHEN m.level = 'Gold' THEN '10%'
                WHEN m.level = 'Silver' THEN '5%'
                ELSE '0%'
                END )

            AS 'Diskon_Member',
            CASE 
            WHEN SUM(t.total) > 100000 THEN '10%'
            ELSE '0%'
            END 
            
            AS 'Diskon_barang',
            SUM(t.total) AS 'Total_Pembelian',
            (
                CASE
                WHEN m.level = 'Platinum' THEN SUM(t.total) * 0.15
                WHEN m.level = 'Gold' THEN SUM(t.total) * 0.10
                WHEN m.level = 'Silver' THEN SUM(t.total) * 0.05
                ELSE 0
                END
            ) + (
                CASE 
                WHEN SUM(t.total) > 100000 THEN SUM(t.total) * 0.10
                ELSE 0
                END ) 

            AS 'Total_Diskon',
            SUM(t.total) -
            (
                CASE
                WHEN m.level = 'Platinum' THEN SUM(t.total) * 0.15
                WHEN m.level = 'Gold' THEN SUM(t.total) * 0.10
                WHEN m.level = 'Silver' THEN SUM(t.total) * 0.05
                ELSE 0
                END
            ) - (
                CASE 
                WHEN SUM(t.total) > 100000 THEN SUM(t.total) * 0.10
                ELSE 0
                END )
            AS 'Total_Transaksi'
        FROM member m
        JOIN penjualan j ON m.nama_member = j.nama_member
        JOIN transaksi t ON j.id_penjualan = t.id_penjualan
        GROUP BY m.nama_member, m.level";

        $result = $koneksi->query($query);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['member'] . "</td>";
                echo "<td>" . $row['level'] . "</td>";
                echo "<td>" . $row['Diskon_Member'] . "</td>";
                echo "<td>" . $row['Diskon_barang'] . "</td>";
                echo "<td>" . $row['Total_Pembelian'] . "</td>";
                echo "<td>" . $row['Total_Diskon'] . "</td>";
                echo "<td>" . $row['Total_Transaksi'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Tidak ada data transaksi.";
        }
        $koneksi->close();
        ?>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export Data Kendaraan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Data Kendaraan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kendaraan</th>
                <th>Plat Nomor</th>
                <th>Warna</th>
                <th>IMEI GPS</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kendaraan)) : ?>
                <?php $no = 1; foreach ($kendaraan as $k) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($k['nama']) ?></td>
                        <td><?= htmlspecialchars($k['plat_no']) ?></td>
                        <td><?= htmlspecialchars($k['warna']) ?></td>
                        <td><?= htmlspecialchars($k['imei_gps']) ?></td>
                        <td><?= htmlspecialchars($k['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="6" class="text-center">Data tidak tersedia</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

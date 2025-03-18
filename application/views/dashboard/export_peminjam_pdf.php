<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjam</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Data Peminjam</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Pangkat</th>
                <th>NRP</th>
                <th>NIK</th>
                <th>No Telepon</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peminjam)) : ?>
                <?php $no = 1; foreach ($peminjam as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($p['nama']); ?></td>
                        <td><?= htmlspecialchars($p['jabatan']); ?></td>
                        <td><?= htmlspecialchars($p['pangkat']); ?></td>
                        <td><?= htmlspecialchars($p['nrp']); ?></td>
                        <td><?= htmlspecialchars($p['nik']); ?></td>
                        <td><?= htmlspecialchars($p['no_telepon']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Data peminjam tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

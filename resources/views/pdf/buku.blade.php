<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Book List</h2>
   <table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Writer</th>
            <th>Publisher</th>
            <th>Publication Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bukus as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->penulis }}</td>
                <td>{{ $item->penerbit }}</td>
                <td>{{ $item->tahun_terbit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
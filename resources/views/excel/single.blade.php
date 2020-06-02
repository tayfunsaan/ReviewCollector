<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Başlık</th>
        <th>Yıldız</th>
        <th>Kullanıcı</th>
        <th>Tarih</th>
        <th>Onay</th>
        <th>Yorum</th>
    </tr>
    </thead>
    @foreach($comments as $v)
        <tr>
            <td>{!! $v->title !!}</td>
            <td>{!! $v->star !!}</td>
            <td>{!! $v->name !!}</td>
            <td>{!! $v->date !!}</td>
            <td>{!! $v->verified !!}</td>
            <td>{!! $v->body !!}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

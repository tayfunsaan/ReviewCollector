<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="container">
    <div class="row text-center">
        <div class="col mt-5">
            <a href="{!! route('links') !!}"><button type="button" class="btn btn-dark mb-2">Geri Dön</button></a> <br />
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center mt-5">
        <div class="col">
            <select class="form-control" id="lang">
                <option value="all">Tüm Ülkeler</option>
                <option value="turkey" @if(isset($request['lang']) && $request['lang'] == 'turkey'){!! 'selected="selected"' !!}@endif>Türkiye</option>
                <option value="australia" @if(isset($request['lang']) && $request['lang'] == 'australia'){!! 'selected="selected"' !!}@endif>Avustralya</option>
                <option value="canada" @if(isset($request['lang']) && $request['lang'] == 'canada'){!! 'selected="selected"' !!}@endif>Kanada</option>
                <option value="england" @if(isset($request['lang']) && $request['lang'] == 'england'){!! 'selected="selected"' !!}@endif>İngiltere</option>
                <option value="usa" @if(isset($request['lang']) && $request['lang'] == 'usa'){!! 'selected="selected"' !!}@endif>Amerika</option>
            </select>
        </div>
        <div class="col">
            <select class="form-control" id="star">
                <option value="all">Tüm Puanlar</option>
                <option value="1" @if(isset($request['star']) && $request['star'] == 1){!! 'selected="selected"' !!}@endif>1</option>
                <option value="2" @if(isset($request['star']) && $request['star'] == 2){!! 'selected="selected"' !!}@endif>2</option>
                <option value="3" @if(isset($request['star']) && $request['star'] == 3){!! 'selected="selected"' !!}@endif>3</option>
                <option value="4" @if(isset($request['star']) && $request['star'] == 4){!! 'selected="selected"' !!}@endif>4</option>
                <option value="5" @if(isset($request['star']) && $request['star'] == 5){!! 'selected="selected"' !!}@endif>5</option>
            </select>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row pl-5 pr-5">
        <div class="col">
            <table class="table table-hover table-responsive  mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th class="">Ülke</th>
                        <th class="">Başlık</th>
                        <th class="">Yıldız</th>
                        <th class="">Kullanıcı</th>
                        <th class="">Tarih</th>
                        <th class="">Onay</th>
                        <th class="">Yorum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $v)
                        <tr>
                            <td>{!! $v->lang_text !!}</td>
                            <td>{!! $v->title !!}</td>
                            <td>{!! $v->star !!}</td>
                            <td>{!! $v->name !!}</td>
                            <td>{!! $v->date !!}</td>
                            <td>{!! $v->verified !!}</td>
                            <td>{!! $v->body !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable();
        $( "#lang, #star" ).change(function() {
            let lang = $('#lang').val();
            let star = $('#star').val();
            let url = '{!! route('table',$id) !!}?lang='+lang+'&star='+star;
            window.location = url;
        });
    } );
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .spinner.small div {
            height: 8px;
            width: 8px;
        }

        .spinner > div {
            width: 13px;
            height: 13px;
            background-color: #049cff;
            border-radius: 50%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%, 80%, 100% { -webkit-transform: scale(0) }
            40% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bouncedelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            } 40% {
                  -webkit-transform: scale(1.0);
                  transform: scale(1.0);
              }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row text-center mt-5">
        <div class="col">
            <a href="{!! route('links') !!}"><button type="button" class="btn btn-dark mb-2">Linklere Geri Dön</button></a> <br />
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="table_spin text-center"></div>
            <table class="table table-hover table-responsive  mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th class="">Başlık</th>
                        <th class="">Linkler</th>
                        <th class="">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $v)
                        <tr>
                            <td>{!! $v->title !!}</td>
                            <td>
                                <a href="{!! $v->turkey !!}" target="_blank">{!! $v->turkey !!}</a> <br />
                                <a href="{!! $v->australia !!}" target="_blank">{!! $v->australia !!}</a> <br />
                                <a href="{!! $v->canada !!}" target="_blank">{!! $v->canada !!}</a> <br />
                                <a href="{!! $v->england !!}" target="_blank">{!! $v->england !!}</a> <br />
                                <a href="{!! $v->usa !!}" target="_blank">{!! $v->usa !!}</a> <br />
                            </td>
                            <td>
                                <a href="{!! route('links.delete', [$v->id]) !!}"><button type="button" class="btn btn-dark mb-2">Sil</button></a> <br />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-center mt-5">
        <div class="col">
            <form method="post" action="{!! route('links.save') !!}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Başlık</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Türkiye</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="turkey">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Avustralya</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="australia">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kanada</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="canada">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">İngiltere</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="england">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Amerika</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="usa">
                </div>
                <button type="submit" class="btn btn-dark mb-5">Kaydet</button>
            </form>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    (function($){

        $.fn.jmspinner = function(value){
            var small = 'small';
            var custom = 'custom';
            var large = 'large';
            var div_bounces ='';
            var div  = document.createElement('div');
            var plc = $(div).prop('class', 'spin_loading');
            var inner = document.createElement('div');
            var center_loading = $(inner).prop('class', 'spinner');
            var made = $(plc).html(center_loading);
            var bce1 = document.createElement('div');
            var bce2 = document.createElement('div');
            var bce3 = document.createElement('div');
            var div_btn_1 = $(bce1).prop('class', 'bounce1');
            var div_btn_2 = $(bce2).prop('class', 'bounce2');
            var div_btn_3 = $(bce3).prop('class', 'bounce3');
            // returning the bounce divs to the template

            //var div_inner_bounces = $(div_bounces).html(div_btn);
            var divs_bts;
            var index = 0;
            var loading =  [];
            loading.push(div_btn_1,div_btn_2, div_btn_3);


            $.each(loading, function(i, index){

                divs_bts = $(center_loading).append(index);

            });

            if(value == 'small'){
                var small = $(divs_bts).addClass('small');
                this.html(small);
                return this;
            }
            if(value == 'large'){
                var large = $(divs_bts).addClass('large');
                this.html(large);
                return this;
            }
            if(value == null){
                var detf = $(divs_bts).addClass('large');
                this.html(detf);
                return this;
            }

            if(value == false){
                this.find('.spinner').remove();
                return this;
            }


        }


    }(jQuery));
</script>
<script>
    function updateComment(url){
        $('.table_spin').jmspinner();
        $.ajax({
            type: "GET",
            url: url,
            success: function(data){
                if(data == 'OK'){
                    swal ( "Onay" ,  "Yorumlar güncellendi." ,  "success" );
                }else{
                    swal ( "Hata" ,  "Yorumlar güncellenemedi." ,  "error" );
                }
                $('.table_spin').jmspinner(false);
            },
            error: function(){
                swal ( "Hata" ,  "Yorumlar güncellenemedi." ,  "error" );
                $('.table_spin').jmspinner(false);
            }
        });
    }
</script>
</body>
</html>

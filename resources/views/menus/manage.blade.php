<link  href="{{ asset('/assets/css/nestable.css') }}" rel="stylesheet">

<div class="panel panel-info">
    
    <div class="panel-body">
        <div class="col-md-12">
            <div class="col-md-6 pull-right manage-menu text-right" style="" data-spy="affix" data-offset-top="210">
                <form id="order-form" method="post" action="{{ route('menus.update_menu_order') }}">
                    {{ csrf_field() }}
                    <textarea id="nestable-output" name="menus" style="display: none"></textarea>
                    <div class="text-right" style="margin-top: 10px">
                    <span>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </span>
                    </div>
                </form>
            </div>
            {!! create_menus_list($menus) !!}
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript" src="{{ asset('/assets/js/jquery.nestable.js') }}"></script>
    <script>
         
        $(function () {
            $('.dd').nestable().on('change', updateOutput);

            updateOutput($('.dd').data('output', $('#nestable-output')));

            $('.dd-handle').on('click', function(e){
                alert(e.data('id'));
            });
        });
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this feature.');
            }
        };
        function save_order(){
            $('#order-form').submit();
        }

        $(window).mousemove(function (e) {
            if ($('.dd-dragel') && $('.dd-dragel').length > 0 && !$('html, body').is(':animated')) {
                var bottom = $(window).height() - 50,
                    top = 50;

                if (e.clientY > bottom && ($(window).scrollTop() + $(window).height() < $(document).height() - 100)) {
                    $('html, body').animate({
                        scrollTop: $(window).scrollTop() + 300
                    }, 600);
                }
                else if (e.clientY < top && $(window).scrollTop() > 0) {
                    $('html, body').animate({
                        scrollTop: $(window).scrollTop() - 300
                    }, 600);
                } else {
                    $('html, body').finish();
                }
            }
        });
    </script>
@endsection
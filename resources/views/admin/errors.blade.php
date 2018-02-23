@if (count($errors) > 0)
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-errors">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">有错误哦~</div>
            <div class="am-modal-bd">
                <div class="alert-danger" id="info">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <script src="/assets_admin/js/amazeui.min.js"></script>
    <script>
        console.log(123)
          $('#my-errors').modal()
    </script>
@endif

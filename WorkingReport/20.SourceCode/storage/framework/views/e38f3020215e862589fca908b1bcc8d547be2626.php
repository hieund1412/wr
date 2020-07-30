<?php $__env->startSection('content'); ?>
    <div class="wrapper">
        <h1><div class="header">Quản lý dự án</div></h1>
        <div class="row">
            <div class="col-xs-4">
                Pháp Nhân:
                <select name="" id="">
                    <option>AGRIMEDIA</option>
                    <option>abc acb</option>
                </select>
            </div>
            <div class="col-xs-4">
                Tên dự án
                <input type="text">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary btn-fill btn-wd">Tra cứu</button>
            </div>
        </div>

        
            <button type="button" class="btn btn-success btn-fill btn-wd" data-toggle="modal" data-target="#create_project">Thêm mới dự án</button>
        
        <table class="table" border="1">
            <thead class="thead-light">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Pháp nhân</th>
                <th scope="col">Tên dự án</th>
                <th scope="col">Mô tả dự án</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>KCN</td>
                <td>Khối công nghệ</td>
                <td>@button</td>
                <td>
                    <a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#update_project">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>B2C</td>
                <td>Khối B2C</td>
                <td>@button</td>
                <td>
                    <a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#update_project">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="fa fa-times"></i></a>
                </td>

            </tr>
            <tr>
                <th scope="row">3</th>
                <td>B2B</td>
                <td>Khối B2B</td>
                <td>@button</td>
                <td>
                    <a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#update_project">
                       <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="fa fa-times"></i></a>
                </td>
            </tr>

            </tbody>


        </table>
        <div class="btn-group">
            <button type="button" class="btn btn-default"><</button>
            <button type="button" class="btn btn-default">1</button>
            <button type="button" class="btn btn-default">2</button>
            <button type="button" class="btn btn-default">></button>
        </div>
    </div>


    


    <div class="modal fade" id="create_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới Khối</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pháp nhân<star>*</star></label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tên dự án<star>*</star></label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mô tả dự án</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Quay lại</button>
                    <button class="btn btn-primary btn-fill btn-wd">Cập nhật</button>

                </div>
            </div>
        </div>
    </div>


    

    <div class="modal fade" id="update_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới Khối</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pháp nhân<star>*</star></label>

                                <div class="btn-group bootstrap-select open"><button type="button" class="btn dropdown-toggle bs-placeholder btn-default btn-block" data-toggle="dropdown" role="button" title="Single Select" aria-expanded="true"><span class="filter-option pull-left">Single Select</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox" style="max-height: 136px; overflow: hidden; min-height: 109px;"><ul class="dropdown-menu inner" role="listbox" aria-expanded="true" style="max-height: 134px; overflow-y: auto; min-height: 107px;"><li data-original-index="1"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Bahasa Indonesia</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="2"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Bahasa Melayu</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="3"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Català</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="4"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Dansk</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="5"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Deutsch</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="6"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">English</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="7"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Español</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="8"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Eλληνικά</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="9"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Français</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="10"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Italiano</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="11"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Magyar</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="12"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Nederlands</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="13"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Norsk</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="14"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Polski</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="15"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Português</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="16"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Suomi</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="17"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Svenska</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="18"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Türkçe</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="19"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Íslenska</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="20"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Čeština</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="21"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Русский</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="22"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">ภาษาไทย</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="23"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">中文 (简体)</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="24"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">中文 (繁體)</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="25"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">日本語</span><span class="material-icons  check-mark"> done </span></a></li><li data-original-index="26"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">한국어</span><span class="material-icons  check-mark"> done </span></a></li></ul></div><select name="cities" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98"><option class="bs-title-option" value="">Single Select</option>
                                        <option value="id">AGRIMEDIA</option>
                                    </select></div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tên dự án<star>*</star></label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mô tả dự án</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Quay lại</button>
                    <button class="btn btn-primary btn-fill btn-wd">Cập nhật</button>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\training\WorkingReport\trunk\20.SourceCode\Modules\Blocks\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>
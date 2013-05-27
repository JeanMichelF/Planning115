<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 08/05/13
 * Time: 00:02
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="row-fluid">
    <form class="offset2 span8 text-center" id="uploadForm" action="./upload-fichier" enctype="multipart/form-data" method="post">
        <fieldset>
            <legend>Uploadez votre fichier</legend>
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-append">
                    <div class="uneditable-input span3">
                        <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
                    </div>
                    <span class="btn btn-file">
                        <span class="fileupload-new"><i class="icon-folder-open"></i>&nbsp;Planning Excel</span>
                        <span class="fileupload-exists">Changer</span>
                        <input type="file" name="fichier" id="fichier" required="required" />
                    </span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                </div>
            </div>

            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="<?php echo $maxsize; ?>" />
            <?php
            /*
            <div>
                <label for="fileselect">Files to upload:</label>
                <input type="file" id="fileselect" name="fileselect" />
                <div id="filedrag">or drop files here</div>
            </div>
            <div id="submitbutton">
                <button type="submit">Upload Files</button>
            </div>
            <div id="messages">
                <p>Status Messages</p>
            </div>
            */
            ?>
            <button class="btn btn-primary btn-large" type="submit" id="btnConvert">
                <i class="icon-wrench"></i>&nbsp;Convertir !
            </button>
            <?php
            /*
                <p class="help-block">Vous pouvez aussi glisser-déposer le fichier ici.</p>-->
            */
            ?>
        </fieldset>
    </form>
</div>

<script>
    <?php
        if (isset($errorMessage)):
    ?>
    var uneditableinput = $('div.uneditable-input');
    _popover = $(uneditableinput).popover({
        trigger: "manual",
        placement: "top",
        content: '<i class="icon-warning-sign icon-large"></i>&nbsp;<?php echo $errorMessage ?>',
        delay: {show: 500, hide: 100},
        html: 'true',
        template: '<div class="popover"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content text-error"><p></p></div></div></div>'
    });
    uneditableinput.addClass("customerror");
    _popover.popover('show');
    $('#btnConvert').prop('disabled', true);
    <?php
        endif;
    ?>
</script>
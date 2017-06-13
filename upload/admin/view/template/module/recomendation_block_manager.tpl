<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" xmlns="http://www.w3.org/1999/html">
  <style type="text/css">
    .links_group{
      border-bottom: dotted #cccccc 1px;
      margin-bottom: 20px;
    }
    .links_group .products{
      height: 150px;
      overflow: auto;
      resize: vertical;
    }

    .scrollbox {
      overflow-y: scroll;
    }

    .scrollbox i {
      float: right;
      cursor: pointer;
      color: red;
      display: inline-block
    }

    .scrollbox div {
      padding: 5px;
      font-size: 1.4em;
      vertical-align: middle;
    }
    .scrollbox div input {
      margin: 0px;
      padding: 0px;
    }
    .scrollbox div.even {
      background: #FFFFFF;
    }
    .scrollbox div.odd {
      background: #E4EEF7;
    }

    .image-info {
      margin-top: 20px;
      position: relative;
    }

  </style>
  <!--Шапка -->
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>

      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <!--Шапка -->

  <div class="container-fluid">

    <!--Инфа об ошибках и сохранении настроек -->
    <?php if ($success) { ?>
    <div class="alert alert-success" id="successdiv"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <!--Инфа об ошибках и сохранении настроек -->


    <div class="row">
      <div class="col-sm-12">

        <h3 style="color: darkred; text-decoration: underline;">Внимание!!! Товары добавляются в обратном порядке, т.е. последний товар в списке - это первый товар на сайте!</h3>
        <h3 style="color: #0C192E; text-decoration: underline;">Если поле пустое - соответствующие товары выводятся без изменений, стандартным способом. Если заполнено хотя-бы одно значение, товары выводятся именно так как заполнены, т.е. заполнен один товар - выводится один. И так далее.</h3>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">



          <!-- Рекомендации -->

          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <i class="fa fa-pencil"></i> Добавь товары, которые нужно вывести в разделе в разделе <b>"Рекомендуемые товары"</b>:
                </h3>
              </div>

              <div class="driveMe">
                <label class="control-label" for="input-product-rec" style="margin-left: 2em;"><?php echo $entry_product; ?></label>
                <div style="margin-left: 2em; margin-bottom: 15px;">
                  <input type="text" name="product-rec" value="" />
                </div>
                <div id="recomendation_block_manager_rec" class="scrollbox well well-sm" style="height: 150px; overflow: auto; margin-left: 2em; margin-right: 2em;">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($products_rec as $product_rec) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="recomendation_block_manager_rec<?php echo $product_rec['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_rec['name'] ?><i class="fa fa-times"></i>
                    <input type="hidden" value="<?php echo $product_rec['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
                <input type="hidden" name="recomendation_block_manager_rec" value="<?php echo $recomendation_block_manager_rec; ?>" />
              </div>

            </div>
          </div>

          <!-- / Рекомендации -->


          <!-- Популярные -->

          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <i class="fa fa-pencil"></i> Добавь товары, которые нужно вывести в разделе в разделе <b>"Популярные"</b>:
                </h3>
              </div>

              <div class="driveMe">
                <label class="control-label" for="input-product-popular" style="margin-left: 2em;"><?php echo $entry_product; ?></label>
                <div style="margin-left: 2em; margin-bottom: 15px;">
                  <input type="text" name="product-popular" value="" />
                </div>
                <div id="recomendation_block_manager_popular" class="scrollbox well well-sm" style="height: 150px; overflow: auto; margin-left: 2em; margin-right: 2em;">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($products_pop as $product_pop) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="recomendation_block_manager_popular<?php echo $product_pop['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_pop['name'] ?><i class="fa fa-times"></i>
                    <input type="hidden" value="<?php echo $product_pop['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
                <input type="hidden" name="recomendation_block_manager_popular" value="<?php echo $recomendation_block_manager_popular; ?>" />
              </div>

            </div>
          </div>

          <!-- / Популярные -->


          <!-- Хиты -->

          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <i class="fa fa-pencil"></i> Добавь товары, которые нужно вывести в разделе в разделе <b>"Хит продаж"</b>:
                </h3>
              </div>

              <div class="driveMe">
                <label class="control-label" for="input-product-hit" style="margin-left: 2em;"><?php echo $entry_product; ?></label>
                <div style="margin-left: 2em; margin-bottom: 15px;">
                  <input type="text" name="product-hit" value="" />
                </div>
                <div id="recomendation_block_manager_hit" class="scrollbox well well-sm" style="height: 150px; overflow: auto; margin-left: 2em; margin-right: 2em;">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($products_hit as $product_hit) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="recomendation_block_manager_hit<?php echo $product_hit['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_hit['name'] ?><i class="fa fa-times"></i>
                    <input type="hidden" value="<?php echo $product_hit['product_id']; ?>" />
                  </div>
                <?php } ?>
                </div>
                <input type="hidden" name="recomendation_block_manager_hit" value="<?php echo $recomendation_block_manager_hit; ?>" />
              </div>

            </div>
          </div>

          <!-- / Хиты -->


          <!-- Новинки -->

          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <i class="fa fa-pencil"></i> Добавь товары, которые нужно вывести в разделе в разделе <b>"Новинки"</b>:
                </h3>
              </div>

              <div class="driveMe">
                <label class="control-label" for="input-product-news" style="margin-left: 2em;"><?php echo $entry_product; ?></label>
                <div style="margin-left: 2em; margin-bottom: 15px;">
                  <input type="text" name="product-news" value="" />
                </div>
                <div id="recomendation_block_manager_news" class="scrollbox well well-sm" style="height: 150px; overflow: auto; margin-left: 2em; margin-right: 2em;">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($products_news as $product_news) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="recomendation_block_manager_news<?php echo $product_news['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_news['name'] ?><i class="fa fa-times"></i>
                    <input type="hidden" value="<?php echo $product_news['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
                <input type="hidden" name="recomendation_block_manager_news" value="<?php echo $recomendation_block_manager_news; ?>" />
              </div>

            </div>
          </div>

          <!-- / Новинки -->

        </form>
      </div>
    </div>
  </div>


  <!--- Автокомплит для нескольких полей -->

  <script type="text/javascript"><!--

      $(function(){

          $('.driveMe').each(function(){
              var inputName = $(this).find('div input:visible').attr('name');
              var idBlock = $(this).find('div:nth-child(3)').attr('id');

              $('input[name=\'' + inputName + '\']').autocomplete({

                  delay: 500,
                  source: function(request, response) {
                      $.ajax({
                          url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&enabled&filter_name=' +  encodeURIComponent(request) + '&filter_model=' + encodeURIComponent(request) + '&filter_sku=' + encodeURIComponent(request),
                          dataType: 'json',
                          success: function(json) {
                              response($.map(json, function(item) {
                                  return {
                                      label: item.name,
                                      value: item.product_id
                                  }
                              }));
                          }
                      });
                  },

                  select: function(item) {
                      $('input[name=\'' + inputName + '\']').val('');

                      $("#" + idBlock + item['value']).remove();

                      $("#" + idBlock).append('<div id="' + idBlock + item['value'] + '">' + item['label'] + '<i class="fa fa-times"></i>' + '<input type="hidden" name="product_rec[]" value="' + item['value'] + '" /></div>');

                      $("#" + idBlock + ' div:odd').attr('class', 'odd');
                      $("#" + idBlock + ' div:even').attr('class', 'even');

                      var data = $.map($("#" + idBlock + ' input'), function(element){
                          return $(element).attr('value');
                      });

                      $('input[name=\'' + idBlock + '\']').attr('value', data.join());

                      return false;
                  },

                  focus: function(item) {
                      return false;
                  }
              });


              $("#" + idBlock).delegate('.fa-times', 'click', function() {
                  $(this).parent().remove();

                  $("#" + idBlock + ' div:odd').attr('class', 'odd');
                  $("#" + idBlock + ' div:even').attr('class', 'even');

                  var data = $.map($("#" + idBlock + ' input'), function(element){
                      return $(element).attr('value');
                  });

                  $('input[name=\'' + idBlock + '\']').attr('value', data.join());
              });

              });

      });

      //--></script>

  <!--- / Автокомплит для нескольких полей -->



  <!--Функция скрывает div с инфой о сохранении настроек-->
  <script type="text/javascript">
      $(function hide_success_text() {
          $('#successdiv').delay(6000).fadeOut();
      })
  </script>
  <!-- / Функция скрывает div с инфой о сохранении настроек-->

  <!--Функция скрывает и открывает div с инфой про имперку-->
  <script>
      var show;
      function hidetxt(type){
          param=document.getElementById(type);
          if(param.style.display == "none") {
              if(show) show.style.display = "none";
              param.style.display = "block";
              show = param;
          }else param.style.display = "none"
      }
  </script>
  <!--/ Функция скрывает и открывает div с инфой про имперку-->


  <?php echo $footer; ?>
<?php
//подключаем пролог ядра bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//устанавливаем заголовок страницы
$APPLICATION->SetTitle("AJAX");

//Инициализируем библиотеку ajax
CJSCore::Init(array('ajax'));

//Проверяем есть ли запрос из формы "testAjax", потом перезагружаем Буфер, выводим JSON 'RESULT' => 'HELLO',
//        'ERROR' => '', завершаем выполнение кода.
$sidAjax = 'testAjax';
if(isset($_REQUEST['ajax_form']) && $_REQUEST['ajax_form'] == $sidAjax){
    $GLOBALS['APPLICATION']->RestartBuffer();
    echo CUtil::PhpToJSObject(array(
        'RESULT' => 'HELLO',
        'ERROR' => ''
    ));
    die();
}

?>
    //HTML блок.
    <div class="group">
        <div id="block"></div >
        <div id="process">wait ... </div >
    </div>

    <script>
        //Включаем дебагер
        window.BXDEBUG = true;

        function DEMOLoad(){

            BX.hide(BX("block"));//Сворачиваем див с id block
            BX.show(BX("process")); //Показываем див с id process
            BX.ajax.loadJSON(
                '<?=$APPLICATION->GetCurPage()?>?ajax_form=<?=$sidAjax?>',//Получить путь текущий страницы БЕЗ index.php
                DEMOResponse
            );
        }
        function DEMOResponse (data){
            BX.debug('AJAX-DEMOResponse ', data); //Вывод дебаг
            BX("block").innerHTML = data.RESULT;//Выводим в див block "data.RESULT"
            BX.show(BX("block")); //Показываем block
            BX.hide(BX("process")); // Скрываем process

            BX.onCustomEvent( //Функция вызывает все обработчики события
                BX(BX("block")),
                'DEMOUpdate'
            );
        }

        BX.ready(function(){
            /*
            BX.addCustomEvent(BX("block"), 'DEMOUpdate', function(){
               window.location.href = window.location.href;
            });
            */
            BX.hide(BX("block"));
            BX.hide(BX("process"));

            //функция устанавливает событие click на дочерний элемент с классом css_ajax
            // если кликаем вызываем функцию DEMOLoad();
            // Очищаем событие.
            BX.bindDelegate(
                document.body, 'click', {className: 'css_ajax' },
                function(e){
                    if(!e)
                        e = window.event;

                    DEMOLoad();
                    return BX.PreventDefault(e);
                }
            );

        });

    </script>
    <div class="css_ajax">click Me</div>
<?
//подключаем эпилог ядра bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
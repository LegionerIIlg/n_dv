<?php
   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Страница информации</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Legioner">
        <meta name="publisher-email" content="" />
        <meta name="robots" content="index, follow" />
        <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    </head>
    <body>



       
            <div class="container">

                
                
                 <div class="row d-flex justify-content-between mb-5 mt-3">
                    <div class="col-sm-9">
                        <h3 class="text-start">Вы ввошли как: <?=$login;?></h3>
                    </div>
                    <div class="col-sm-3 text-end">
                        <button onclick="enterDestroyFunction()" 
                                type="button" class="btn btn-danger">Выйти</button>
                    </div>
                </div>
               
                
                <div class="row d-flex justify-content-between">
                    <div class="col-8">
                        <h3 class="text-start">Таблица сущностей</h3>
                    </div>
                    <div class="col-3 text-end">
                        <button onclick="functionGetTable()" 
                                type="button" class="btn btn-outline-info">Обновить</button>
                        <button onclick="$('#modalAdd').modal('show')" 
                                type="button" class="btn btn-success">Добавить</button>
                    </div>
                </div>
                

                <table class="table table-bordered table-hover w-100  mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">phone</th>
                            <th scope="col">keyt(key: зарезервировано базой - пришлось изменить)</th>
                            <th scope="col">Добавлен</th>
                            <th scope="col">Обновлен</th>
                            <th scope="col">Действия </th>
                        </tr>
                    </thead>
                    <tbody id="table-body">

                        <?php if (!empty($table_body))
                               foreach ($table_body as $k => $v):
                                   ?> 
                                   <tr data-id ="<?= $v['id'] ?>" >
                                       <th><?= $v['id'] ?></th>
                                       <td><?= $v['name']; ?></td>
                                       <td><?= $v['phone']; ?></td>
                                       <td><?= $v['keyt']; ?></td>
                                       <td><?php echo date('d.m.Y H:i:s', strtotime($v['created_at'])); ?></td>
                                       <td><?php echo date('d.m.Y H:i:s', strtotime($v['updated_at'])); ?></td>
                                       <td>
                                           <span class="btn-group">
                                               <button type="button" onclick="functionChange(this)" class="btn btn-warning">Изм.</button>
                                               <button type="button" onclick="functionLog(this)" class="btn btn-info">Лог</button>
                                              
                                               
                                               <button type="button" onclick="functionDestroy(this)" class="btn btn-dark">Удалить</button>
                                           </span>
                                       </td>

                                   </tr>
       <?php endforeach; ?>

                    </tbody>
                </table>





            </div>





        
        
        
        <div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Добавить</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
      <form action="/index.php/?mainurl=addnew" id="formInput"  onsubmit="return addNewFunction(this)">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="" class="form-control" id="inputAddName" placeholder="" maxlength="255" required="true">
                            </div>

                       
                            <div class="mb-3">
                                <label  class="form-label">Phone</label>
                                <input type="tel" name="phone" maxlength="15"  value="" class="form-control" 
                                       id="inputAddPhone" placeholder="" required="true">
                            </div>

          <div class="mb-3">
                                <label  class="form-label">Key</label>
                                <input type="text" 
                                       name="key" 
                                       maxlength="25"  
                                       value="" 
                                       class="form-control" 
                                       id="inputAddKey" 
                                       placeholder="" 
                                       required="true">
                            </div>                  
          
          
                            <div class="d-inline-block w-100 text-end">
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </div>

                        </form>
      
      
      </div>
    </div>
  </div>
</div>
        
        
        
        
        
        
        <div class="modal fade" id="modalChange">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Изменить</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
      <form action="/index.php/?mainurl=savechange" id="formInput"  onsubmit="return saveChangeNowFunction(this)">
                            
          
          <input type="hidden" name="record" value="" class="form-control" id="inputChangeRecord">
                    <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="" class="form-control" 
                                       id="inputChangeName" 
                                       placeholder="" 
                                       maxlength="255" 
                                       required="true">
                            </div>

                       
                            <div class="mb-3">
                                <label  class="form-label">Phone</label>
                                <input type="tel" 
                                       name="phone" 
                                       maxlength="15"  
                                       value="" 
                                       class="form-control" 
                                       id="inputChangePhone" 
                                       placeholder="" 
                                       required="true">
                            </div>

          <div class="mb-3">
                                <label  class="form-label">Key</label>
                                <input type="text" 
                                       name="key" 
                                       maxlength="25"  
                                       value="" 
                                       class="form-control" 
                                       id="inputChangeKey" 
                                       placeholder="" 
                                       required="true">
                            </div>                  
          
          
                            <div class="d-inline-block w-100 text-end">
                                <button type="submit" class="btn btn-success">Применить</button>
                            </div>

                        </form>
      
      
      </div>
    </div>
  </div>
</div>
        
        
        
        
        <div class="modal fade" id="modalLogs">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Просмотр лога</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalLogBody">
          
      </div>
    </div>
  </div>
</div>
        
        
        
        
        <script src="/assets/js/jquery-3.5.1.js"></script>


        <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="/assets/js/jquery.blockUI.js"></script>
        <script src="/assets/js/main.js?id=<?= rand(1, 150); ?>"></script>





    </body>
</html>

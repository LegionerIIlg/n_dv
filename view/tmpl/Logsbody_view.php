<?php
   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>



<div class="table-responsive">
<table class="table table-bordered table-hover w-100 table-  mx-auto">
                    <thead>
                        <tr>
                        
                            <th scope="col">Пользователь</th>
                            <th scope="col">Дейстиве</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Предыдущая версия данных</th>
                            <th scope="col">Обновленые данные</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($data_logs))
                               foreach ($data_logs as $k => $v):
                                   ?> 
                                   <tr >
                                       <td><?= $v['user']; ?></td>
                                       <td><?= $v['what']; ?></td>
                                       <td><?php echo date('d.m.Y H:i:s', strtotime($v['time'])); ?></td>
                                       <td>
                                           <div class="row">
                                               <div class="col-4"> <strong>name</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['before_data']['name'];?>
                                               </div>
                                           </div>
                                              <div class="row">
                                               <div class="col-4"> <strong>phone</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['before_data']['phone'];?>
                                               </div>
                                           </div>
                                           
                                           <div class="row">
                                               <div class="col-4"> <strong>key</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['before_data']['keyt'];?>
                                               </div>
                                           </div>
                                         </td>
                                       <td>
                                           <div class="row">
                                               <div class="col-4"> <strong>name</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['last_data']['name'];?>
                                               </div>
                                           </div>
                                              <div class="row">
                                               <div class="col-4"> <strong>phone</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['last_data']['phone'];?>
                                               </div>
                                           </div>
                                           
                                           <div class="row">
                                               <div class="col-4"> <strong>key</strong></div>
                                               <div class="col-8"><?php                                                                                      echo  $v['last_data']['key'];?>
                                               </div>
                                           </div>
                                           </td>
                                       
                                       

                                   </tr>
       <?php endforeach; ?>

                    </tbody>
</table>
</div>
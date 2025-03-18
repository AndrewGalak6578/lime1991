<section>
   <div class="row">
       <div class="col-12 ">
           <b class="text-primary">Метки</b>
           <hr class="border-primary">
       </div>
       <div class="col-2">
           <div class="form-group">
               <input type="checkbox" id="sale" value="1" name="labels[]">
               <label for="sale">Распродажа</label>
           </div>
       </div>
       <div class="col-2">
           <div class="form-group">
               <input type="checkbox" id="hit" value="2" name="labels[]">
               <label for="hit">Хит</label>
           </div>
       </div>
       <div class="col-2">
           <div class="form-group">
               <input type="checkbox" id="new" value="3" name="labels[]">
               <label for="new">Новинка</label>
           </div>
       </div>
       <div class="col-3">
           <div class="form-group">
               <input type="checkbox" id="free_delivery" value="4" name="labels[]">
               <label for="free_delivery">Бесплатная доставка</label>
           </div>
       </div>
       <div class="col-12 ">
           <b class="text-primary">Медия</b>
           <hr class="border-primary">
       </div>
       <div class="col-12 col-md-6">
           <div class="form-group">
               <label for="cover">Обложка <span class="text-danger">*</span></label>
               <input type="file" class="form-control"  name="cover">
           </div>
       </div>
       <div class="col-12 col-md-6">
           <div class="form-group">
               <label for="photos">Доп.фото</label>
               <input type="file" multiple class="form-control" name="photos[]">
           </div>
       </div>
   </div>
</section>

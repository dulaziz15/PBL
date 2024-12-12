   <div class="body-main" id="modal-tambah-user">
       <div class="card-main">
           <div class="header-card">
               <h3>Edit User</h3>
               <hr>
           </div>
           <div class="body-card">
               <div class="container-card">
                   <form action="../../routes/route.php?page=user&sub=update&id=<?= $_GET['id'] ?>" method="POST">
                       <div class="form-modal">
                           <div class="form-input">
                               <label for="">Username</label>
                               <input type="number" name="username" placeholder="username" id="username">
                           </div>
                           <div class="form-input">
                               <label for="">Email</label>
                               <input type="email" name="email" placeholder="email" id="email">
                           </div>
                           <div class="form-input">
                               <label for="">Password</label>
                               <input type="text" name="password" placeholder="password" id="password">
                           </div>
                           <div class="form-input">
                               <label for="">Password</label>
                               <select name="role" id="role">
                                   <option value="1">Super Admin</option>
                                   <option value="2">Mahasiswa</option>
                                   <option value="3">Admin Jurusan</option>
                                   <option value="4">Admin Prodi</option>
                               </select>
                           </div>
                           <div class="">
                               <input class="btn btn-submit" type="submit" value="Update">
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <script src="ajax/update.js"></script>
   <script>
       updateAjax(<?= $_GET['id'] ?>)
   </script>
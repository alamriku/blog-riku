

   var  modal = document.getElementById('model');

     yes_btn = document.getElementById('yes');
     no_btn = document.getElementById('no');
     var delete_check = document.getElementById('delete');
     var checkYes = onclick(yes_btn);
     var checkNo = onclick(no_btn);
     function deleteCheck()
     {
          modal.style.display = 'block';
          
          if (checkYes)
          {
               checkYes.onclick = function(){
                   modal.style.display = 'none';
                   return true;
               }
               
               
          }

          else
          {
               checkNo.onclick = function()
               {
                     modal.style.display = 'none';
                     return false;
               } 
               

          }
     }


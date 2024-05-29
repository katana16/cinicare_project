function confirme_delete(id){
    let del = confirm('Do you want to delete user');
    
    if(del == true){
      window.location.href="admin_secretary.php?action=del&&id="+id;
    }
}
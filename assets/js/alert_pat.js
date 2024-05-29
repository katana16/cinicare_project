function confirme_delete(id){
    let del = confirm('Do you want to delete user');
    
    if(del == true){
      window.location.href="admin_patients.php?action=del&&id="+id;
    }
}
function confirme_consult(id){
    let com = confirm('Do you complete the consultation ?');
    
    if(com == true){
      window.location.href="doctor_dashboard.php?status=com&&id="+id;
    }
  }
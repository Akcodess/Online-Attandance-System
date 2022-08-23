</div>  <!-- End Row-->
</div>  <!-- End Container-->

<footer>
        <div class="text-center">
            Copyright &copy; All rights reserved! &nbsp;By- AK
        </div>
</footer>

<!-- <script>
function attdelete()
{
  if(confirm('are you sure')){
    console.log("yes");
    window.location = `/OAS/Teacher/Attendancedate.php?delete`;
  }
  {
    console.log("no");
  }
}
</script> -->


<!-- Boostrap JavaScript -->
<script src="../js/jquery.min.js"></script>
<!-- <script src="../js/popper.min.js"></script> -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<!-- Data table -->
<script>
$(document).ready( function () {
    $('#studentTable').DataTable();
} );
</script>

<!-- Data table -->
<script>
$(document).ready( function () {
    $('#AttendanceDate').DataTable();
} );
</script>

<!-- Data table -->
<script>
$(document).ready( function () {
    $('#AttendanceEdit').DataTable();
} );
</script>

<!-- Student Edit -->
<script>
 edits = document.getElementsByClassName('stedit');
 Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("edit");
      tr = e.target.parentNode.parentNode;
      student_name = tr.getElementsByTagName("td")[0].innerText;
      student_roll = tr.getElementsByTagName("td")[1].innerText;
      student_gender = tr.getElementsByTagName("td")[2].innerText;
      student_parent = tr.getElementsByTagName("td")[3].innerText;
      student_mobile = tr.getElementsByTagName("td")[4].innerText;
      console.log(student_name, student_roll, student_gender, student_parent, student_mobile);
      stnameedit.value = student_name;
      strolledit.value = student_roll;
      // stgenderedit.value = student_gender;
      if(student_gender == "MALE"){
      }

      stparentedit.value = student_parent;
      stmobileedit.value = student_mobile;
      stsnoedit.value = e.target.id;
      console.log(e.target.id);
      $('#steditModal').modal('toggle');
    })
 })

// Student Delete
 deletes = document.getElementsByClassName('stdelete');
 Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("delete");
      tr = e.target.parentNode.parentNode;
      student_name = tr.getElementsByTagName("td")[0].innerText;
      student_roll = tr.getElementsByTagName("td")[1].innerText;
      student_gender = tr.getElementsByTagName("td")[2].innerText;
      student_parent = tr.getElementsByTagName("td")[3].innerText;
      student_mobile = tr.getElementsByTagName("td")[4].innerText;
      console.log(student_name, student_roll, student_gender, student_parent, student_mobile);
      stsnodelete.value = e.target.id;
      console.log(e.target.id);
      $('#stdeleteModal').modal('toggle');
    })
 })
</script>



<!-- Click the attendance view button -->
<!-- <script>
   function view() {
       window.location = "Attendancerecords.php";
  }
</script> -->
</body>
</html>
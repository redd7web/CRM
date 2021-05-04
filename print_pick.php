<style>
@page{
    size: 8.5in 11in;
    margin: 0.5in;
} 

#page {
  width:750px;
  height:90%;
  margin:0 auto;
  padding:15px;
  background-size:cover;
  text-align:center;
}

</style>

<div id="page">
<?php echo "<h2>".$_GET['invoice']."</h2>"; ?>
<img src="<?php echo "machforms/machform/data/form_11670/files/".$_GET['pic']; ?>" style="width: 100%;height: 100%;"/>
</div>
<script type="text/javascript">
window.print();
</script>
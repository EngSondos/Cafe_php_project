<script>
    function incrementquantity(num=1,productid=15,userid=2){
        // console.log($num);
        // console.log($productid);
        // console.log($userid);
        res = document.getElementById(productid);
        num++;
        res.innerHTML = <?php update_quantity('num','productid','userid');?>;
    }
</script>

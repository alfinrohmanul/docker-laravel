<table>
    <thead>
          <tr>
        <th colspan="9" style="vertical-align : center;text-align:center;">Data Omset</th>
      </tr>
    <tr>
        <th>No Penjualan</th>
        <th>Tanggal Penjualan</th>
        <th>Nama Konsumen</th>
        <th>Nama File</th>
        <th>Nama Layanan</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Hpp</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $i=0; 
		foreach($invoices as $data){
			$row[$i]=$data;
			$i++;
		  }

		  foreach($row as $cell){
			if(isset($total[$cell->no_penjualan]['jml'])) { 
			  $total[$cell->no_penjualan]['jml']++; 
			}else{
			  $total[$cell->no_penjualan]['jml']=1; 
			}	
		  }
          
		  foreach($row as $cell){
			if(isset($total1[$cell->nama_konsumen]['jml'])) { 
			  $total[$cell->nama_konsumen]['jml']++; 
			}else{
			  $total[$cell->nama_konsumen]['jml']=1; 
			}	
		  }


          $k=1;
          $n=count($row);
          $ceknama="";
          $cekkonsu="";
          $betap="";
          for($i=0;$i<$n;$i++){
          $cell=$row[$i];
          echo '<tr>';
          if($ceknama!=$cell->no_penjualan){
            $date=date_create($cell->tgl_penjualan);
              echo '<td style="vertical-align : center;text-align:center;"' .($total[$cell->no_penjualan]['jml']>1?' rowspan="' .($total[$cell->no_penjualan]['jml']).'">':'>') .$cell->no_penjualan.'</td>';
              echo '<td style="vertical-align : center;text-align:center;"' .($total[$cell->no_penjualan]['jml']>1?' rowspan="' .($total[$cell->no_penjualan]['jml']).'">':'>') .date_format($date,'d-m-Y').'</td>';
              echo '<td style="vertical-align : center;"' .($total[$cell->no_penjualan]['jml']>1?' rowspan="' .($total[$cell->no_penjualan]['jml']).'">':'>') .$cell->nama_konsumen.'</td>';
              $ceknama=$cell->no_penjualan;
              $cekkonsu=$cell->tgl_penjualan;
              $betap=$cell->nama_konsumen;
          }

          echo "<td>$cell->nama_file</td>
          <td>$cell->nama_barang</td>
          <td>$cell->jumlah</td>
          <td>$cell->harga</td>
          <td>$cell->hpp</td>
          <td>$cell->subtotal</td>";
          echo "</tr>";
          }


        ?>
    <!-- @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->no_penjualan }}</td>
            <td>{{ $invoice->tgl_penjualan }}</td>
            <td>{{ $invoice->nama_konsumen }}</td>
            <td>{{ $invoice->nama_file }}</td>
            <td>{{ $invoice->nama_barang }}</td>
        </tr>
    @endforeach -->
    </tbody>
</table>
<table class="tabla" cellspacing=0>
    <thead>
        <th>Sel</th>
        <?php foreach($headers as $header){ ?>
            <th class="capitalize" > <?php echo $header ?> </th> 
        <?php
            }
        ?>
    </thead>
    <tbody>

            <?php 
                //debug($datos);
                foreach ($datos as $dato) {

            ?>

            <tr>
                <td>
                    <input type="checkbox" name="" id="">
                </td>

            <?php 
                foreach ($dato as $key => $value) {      
            ?>                        
                
                <?php 
                    if(!is_null($value)) { 
                ?>
                            <td>
                                
                                <?php
                                    if ($key === 'nombre') {
                                ?>
                                        <a href=<?php echo "/productos/producto?id=". $dato->id; ?> > <?php echo $value; ?> </a>
                                <?php 
                                    }
                                    else {
                                        echo $value;
                                    }
                                ?>

                                    
                            </td>
            <?php       } 

                    } 
                } 
            ?>
        </tr>
    </tbody>
</table>

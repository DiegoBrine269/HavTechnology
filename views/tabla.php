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

            <?php foreach ($dato as $key => $value) { ?>
                        
                <td> <?php echo $value ?></td>

            <?php   } ?>
            <?php } ?>
        </tr>
    </tbody>
</table>

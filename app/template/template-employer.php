<div class="row">
                        <table id="mainTable">
                           <?php generateTable($data); ?>
                        </table>
                    </div>
                </div>
                <div class="six columns">
                    <div id="oriCard">
                        <?php
                            generateCard(array());

                                if ($page_title == "Employers") {
                             
                        ?> 
                    </div>                       
                    <div id="contactCard">
                        <?php       generateContactCard(); 
                                } 
                        ?>
                    </div>
                </div>
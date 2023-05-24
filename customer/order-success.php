<?php $titleOfPage = "Order Success: ".$orderSuccessData['order_id']; ?>

<div class="container mt-5 mb-5 scrollarea">

        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">


                        <div class="invoice p-5">

                            <h5>Your order Confirmed!</h5>

                            <span class="font-weight-bold d-block mt-4">Hello, <?= $_SESSION['username'] ?></span>
                            <span>You order has been confirmed and will be shipped in next two days!</span>

                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                <table class="table table-borderless">
                                    
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order Date</span>
                                                <span><?= $orderSuccessData['ordered_date'] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order No</span>
                                                <span><?= $orderSuccessData['order_id'] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Payment</span>
                                                <span><?= $paymentType[$orderSuccessData['payment_type']] ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Shiping Address</span>
                                                <span><?= str_replace("#", ", ", $orderSuccessData['shipping_address']) ?></span>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                        </div>
                                <p>You can track your order from my orders section!</p>
                                <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>



                            

                        </div>


                        <div class="d-flex justify-content-between footer p-3">
                        </div>



            
        </div>
                
            </div>
            
        </div>
        
    </div>
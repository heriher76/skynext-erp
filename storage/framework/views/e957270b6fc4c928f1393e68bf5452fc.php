<?php
    $settings_data = \App\Models\Utility::settingsById($invoice->created_by);

?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings_data['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">


    <style type="text/css">
        :root {
            --theme-color: <?php echo e($color); ?>;
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
            font-size: 12px;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 10px;
        }

        .invoice-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 114px;
            height: 114px;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
        }

        .view-qrcode img {
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 30px 25px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 11px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .invoice-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }

        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th {
            text-align: right;
        }

        html[dir="rtl"] .text-right {
            text-align: left;
        }

        html[dir="rtl"] .view-qrcode {
            margin-left: 0;
            margin-right: auto;
        }

        p:not(:last-of-type) {
            margin-bottom: 15px;
        }

        .invoice-summary p {
            margin-bottom: 0;
        }

        .invoice-footer h6 {
            font-size: 43px;
            line-height: 1.2em;
            font-weight: 400;
            margin-top: 15px;
            color: var(--theme-color);
        }
    </style>

    <?php if($settings_data['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
</head>

<body>

    <div class="invoice-preview-main" id="boxes" style="border-right:40px solid var(--theme-color);">
        <div class="invoice-header">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <h3
                                style="text-transform: uppercase; font-size: 38px; font-weight: bold; color: var(--theme-color); margin-bottom: 10px;">
                                <?php echo e(__('INVOICE')); ?></h3>
                            <table class="no-space" style="width: 70%;">
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('Number')); ?>:</td>
                                        <td class="text-right">
                                            <?php echo e(Utility::invoiceNumberFormat($settings, $invoice->invoice_id)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Issue Date')); ?>:</td>
                                        <td class="text-right">
                                            <?php echo e(Utility::dateFormat($settings, $invoice->issue_date)); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo e(__('Due Date:')); ?></b></td>
                                        <td class="text-right"><?php echo e(Utility::dateFormat($settings, $invoice->due_date)); ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="text-right">
                            <img class="invoice-logo" src="<?php echo e($img); ?>" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <?php if($settings['company_name']): ?>
                                    <?php echo e($settings['company_name']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if($settings['mail_from_address']): ?>
                                    <?php echo e($settings['mail_from_address']); ?>

                                <?php endif; ?>
                                <br>
                                <br>
                                <?php if($settings['company_address']): ?>
                                    <?php echo e($settings['company_address']); ?>

                                <?php endif; ?>
                                <?php if($settings['company_city']): ?>
                                    <br> <?php echo e($settings['company_city']); ?>,
                                <?php endif; ?>
                                <?php if($settings['company_state']): ?>
                                    <?php echo e($settings['company_state']); ?>

                                <?php endif; ?>
                                <?php if($settings['company_zipcode']): ?>
                                    - <?php echo e($settings['company_zipcode']); ?>

                                <?php endif; ?>
                                <?php if($settings['company_country']): ?>
                                    <br><?php echo e($settings['company_country']); ?>

                                <?php endif; ?>
                                <?php if($settings['company_telephone']): ?>
                                    <?php echo e($settings['company_telephone']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['registration_number'])): ?>
                                    <?php echo e(__('Registration Number')); ?> : <?php echo e($settings['registration_number']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                                    <?php if(!empty($settings['tax_type']) && !empty($settings['vat_number'])): ?>
                                        <?php echo e($settings['tax_type'] . ' ' . __('Number')); ?> :
                                        <?php echo e($settings['vat_number']); ?>

                                        <br>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </p>
                        </td>
                        <td>
                            <table class="no-space">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="view-qrcode" style="margin-top: 0;">
                                                <?php echo DNS2D::getBarcodeHTML(route('invoice.link.copy', \Crypt::encrypt($invoice->invoice_id)), 'QRCODE', 2, 2); ?>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Bill To')); ?>:</strong>
                            <?php if(!empty($customer->billing_name)): ?>
                                <p>
                                    <?php echo e(!empty($customer->billing_name) ? $customer->billing_name : ''); ?><br>
                                    <?php echo e(!empty($customer->billing_address) ? $customer->billing_address : ''); ?><br>
                                    <?php echo e(!empty($customer->billing_city) ? $customer->billing_city : '' . ', '); ?><br>
                                    <?php echo e(!empty($customer->billing_state) ? $customer->billing_state : '', ', '); ?>,
                                    <?php echo e(!empty($customer->billing_zip) ? $customer->billing_zip : ''); ?><br>
                                    <?php echo e(!empty($customer->billing_country) ? $customer->billing_country : ''); ?><br>
                                    <?php echo e(!empty($customer->billing_phone) ? $customer->billing_phone : ''); ?><br>
                                </p>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <?php if($settings['shipping_display'] == 'on'): ?>
                            <td class="text-right">
                                <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Ship To')); ?>:</strong>
                                <?php if(!empty($customer->shipping_name)): ?>
                                    <p>
                                        <?php echo e(!empty($customer->shipping_name) ? $customer->shipping_name : ''); ?><br>
                                        <?php echo e(!empty($customer->shipping_address) ? $customer->shipping_address : ''); ?><br>
                                        <?php echo e(!empty($customer->shipping_city) ? $customer->shipping_city : '' . ', '); ?><br>
                                        <?php echo e(!empty($customer->shipping_state) ? $customer->shipping_state : '' . ', '); ?>,
                                        <?php echo e(!empty($customer->shipping_zip) ? $customer->shipping_zip : ''); ?><br>
                                        <?php echo e(!empty($customer->shipping_country) ? $customer->shipping_country : ''); ?><br>
                                        <?php echo e(!empty($customer->shipping_phone) ? $customer->shipping_phone : ''); ?><br>
                                    </p>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-body" style="padding-right: 0;">
            <table class="add-border invoice-summary">
                <thead style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
                    <tr>
                        <th><?php echo e(__('Item')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Rate')); ?></th>
                        <th><?php echo e(__('Discount')); ?></th>
                        <th><?php echo e(__('Tax')); ?> (%)</th>
                        <th><?php echo e(__('Price')); ?> <small>after tax & discount</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($invoice->itemData) && count($invoice->itemData) > 0): ?>
                        <?php $__currentLoopData = $invoice->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <?php
                                    $unitName = App\Models\ProductServiceUnit::find($item->unit);
                                ?>
                                <td><?php echo e($item->quantity . ' (' . $unitName->name . ')'); ?></td>
                                <td><?php echo e(Utility::priceFormat($settings, $item->price)); ?></td>
                                <td><?php echo e($item->discount != 0 ? Utility::priceFormat($settings, $item->discount) : '-'); ?>

                                </td>
                                <?php
                                    $itemtax = 0;
                                ?>
                                <td>
                                    <?php if(!empty($item->itemTax)): ?>
                                        <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $itemtax += $taxes['tax_price'];
                                            ?>
                                            <p><?php echo e($taxes['name']); ?> (<?php echo e($taxes['rate']); ?>) <?php echo e($taxes['price']); ?></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(Utility::priceFormat($settings, $item->price * $item->quantity - $item->discount + $itemtax)); ?>

                                </td>
                                <?php if(!empty($item->description)): ?>
                            <tr class="border-0 itm-description">
                                <td colspan="6" style="border-bottom:1px solid <?php echo e($color); ?>;">
                                    <?php echo e($item->description); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><?php echo e(__('Total')); ?></td>
                        <td><?php echo e($invoice->totalQuantity); ?></td>
                        <td><?php echo e(Utility::priceFormat($settings, $invoice->totalRate)); ?></td>
                        <td><?php echo e(Utility::priceFormat($settings, $invoice->totalDiscount)); ?></td>
                        <td><?php echo e(Utility::priceFormat($settings, $invoice->totalTaxPrice)); ?></td>
                        <td><?php echo e(Utility::priceFormat($settings, $invoice->getSubTotal())); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <tr>
                                    <td><?php echo e(__('Subtotal')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->getSubTotal())); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Discount')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->getTotalDiscount())); ?></td>
                                </tr>
                                <?php if(!empty($invoice->taxesData)): ?>
                                    <?php $__currentLoopData = $invoice->taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($taxName); ?> :</td>
                                            <td><?php echo e(Utility::priceFormat($settings, $taxPrice)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo e(__('Total')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->getSubTotal() - $invoice->getTotalDiscount() + $invoice->getTotalTax())); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Paid')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->getTotal() - $invoice->getDue() - $invoice->invoiceTotalCreditNote())); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Credit Note')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->invoiceTotalCreditNote())); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Due Amount')); ?>:</td>
                                    <td><?php echo e(Utility::priceFormat($settings, $invoice->getDue())); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            
            <div style="page-break-before: always;"></div>
            <br><br>
            <table class="add-border invoice-summary" style="padding-top: 50px;">
                <thead style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
                    <tr>
                        <th colspan=2>
                            <center><?php echo e(__('Informasi Pembayaran')); ?></center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan=2>Pembayaran dapat dilakukan melalui rekening A.N GURIANG</td>
                    </tr>
                    <tr>
                        <td width=50%><img src="<?php echo e(url('assets/images/logo_bri.png')); ?>" style="width:25px;">
                            &nbsp;&nbsp;&nbsp;BANK BRI
                        </td>
                        <td width=50%>
                            <h3>113901012880507</h3>
                        </td>
                    </tr>
                    <tr>
                        <td width=50%><img src="<?php echo e(url('assets/images/logo_bca.png')); ?>" style="width:25px;">
                            &nbsp;&nbsp;&nbsp;BANK BCA</td>
                        <td width=50%>
                            <h3>2832136281</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Mohon sertakan dan simpan baik-baik bukti pembayaran. Terimakasih</td>
                    </tr>
                </tbody>
            </table>

            <table class="add-border invoice-summary">
                <thead style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
                    <tr>
                        <th colspan=2>
                            <center><?php echo e(__('Layanan Pelanggan')); ?></center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width=50%>Whatsapp</td>
                        <td width=50%>089665994560</td>
                    </tr>
                    <tr>
                        <td width=50%>E-mail</td>
                        <td width=50%>sportsakka@gmail.com</td>
                    </tr>
                    <tr>
                        <td width=50%>Instagram</td>
                        <td width=50%>@sakkasport.id</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    <?php if(!isset($preview)): ?>
        <?php echo $__env->make('invoice.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
</body>

</html>
<?php /**PATH /Applications/MAMP/htdocs/erp-sakka/resources/views/invoice/templates/template9.blade.php ENDPATH**/ ?>
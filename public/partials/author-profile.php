<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/public/partials
 */
?>

<?php
global $wpdb;

$current_user_id = get_current_user_id(  );
$recipient_id = $wpdb->get_var("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'recipient_account' AND meta_value = $current_user_id");
$user = get_user_by( 'ID', get_current_user_id() );

if(is_user_logged_in(  )){
    $recipient_email = null;
    $recipient_phone = null;
    $payment_way = null;
    $preferred_lang = null;

    $docs_ids = array();
    if($recipient_id){
        $recipient_email = get_post_meta($recipient_id, 'recipient_email', true);
        $recipient_phone = get_post_meta($recipient_id, 'recipient_phone', true);
        $payment_way = get_post_meta($recipient_id, 'payment_way', true);
        $preferred_lang = get_post_meta($recipient_id, 'preferred_lang', true);
        $sponsor_id = get_the_title( $recipient_id );

        $documents = $wpdb->get_results("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'docs_recipients' AND meta_value = $recipient_id");
        $docs_ids = array();
        if($documents){
            foreach($documents as $document_id){
                $docs_ids[] = $document_id->post_id;
            }
        }
    }
    ?>
    <ul class="nav nav-tabs" id="urmProfileTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#urmprofile" role="tab" aria-controls="urmprofile"
                aria-selected="true">Profile</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="receipts-tab" data-toggle="tab" href="#receipts" role="tab" aria-controls="receipts"
                aria-selected="false">Receipts</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="letters-tab" data-toggle="tab" href="#letters" role="tab" aria-controls="letters"
                aria-selected="false">Letters</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tax-documents-tab" data-toggle="tab" href="#tax-documents" role="tab" aria-controls="tax-documents"
                aria-selected="false">Tax Documents</a>
        </li>
    </ul>
    <div class="tab-content" id="urmProfileTabContent">
        <div class="tab-pane fade show active" id="urmprofile" role="tabpanel" aria-labelledby="urmprofile-tab">
            <div class="urm-profile bg-white m-0">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="100px"
                            src="<?php echo get_avatar_url( get_current_user_id(  ) ) ?>">
                            <span class="font-weight-bold"><?php echo __( ucfirst($user->display_name), 'urm-plugin') ?></span>
                            <span class="text-black-50"><?php echo (($recipient_email) ? $recipient_email : $user->user_email) ?></span>
                            <span class="font-weight-bold">ID: <span class="text-black-50">#<?php echo (($sponsor_id) ? $sponsor_id : 'null') ?></span></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-3">
                            <?php
                                if(get_post_meta($recipient_id, 'urm_error', true)){
                                    echo '<div class="alert alert-danger">
                                    '.get_post_meta($recipient_id, 'urm_error', true).'
                                    </div>';
                                    delete_post_meta( $recipient_id, 'urm_error' );
                                }
                            ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <form class="row mt-3" method="post">
                                <input type="hidden" name="recipient_id" value="<?php echo $recipient_id ?>">
                                <div class="col-md-12"><label class="labels">Name</label><input type="text"
                                        class="form-control" name="profile_name" placeholder="Enter full name" value="<?php echo $user->display_name ?>"></div>
                                <div class="col-md-12"><label class="labels">Email ID</label><input type="text"
                                        class="form-control" name="profile_email" placeholder="Enter email id" value="<?php echo $recipient_email ?>"></div>
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text"
                                        class="form-control" name="profile_phone" placeholder="Enter phone number" value="<?php echo $recipient_phone ?>"></div>
                                <div class="col-md-12">
                                    <label class="labels">Payment method</label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value="">Select</option>
                                        <option <?php echo (($payment_way === 'card') ? 'selected' : '') ?> value="card">Card</option>
                                        <option <?php echo (($payment_way === 'cash') ? 'selected' : '') ?> value="cash">Cash</option>
                                        <option <?php echo (($payment_way === 'paypal') ? 'selected' : '') ?> value="paypal">Paypal</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Preferred language</label>
                                    <?php
                                    $args = array(
                                        'id'                          => 'preferred_lang',
                                        'name'                        => 'preferred_lang',
                                        'selected'                    => $preferred_lang,
                                        'echo'                        => 1,
                                        'show_available_translations' => true,
                                        'show_option_site_default'    => false,
                                        'show_option_en_us'           => true,
                                        'explicit_option_en_us'       => true,
                                    );
                            
                                    wp_dropdown_languages($args);
                                    ?>
                                </div>
                                <div class="mt-5 pl-3 pr-3 text-center"><button type="submit" name="save_profile_information" class="btn btn-primary profile-button">Save Profile</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="receipts" role="tabpanel" aria-labelledby="receipts-tab">
            <?php
            $args = array(
                'post_type' => 'urmdocument',
                'numberposts' => -1,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'include'          => $docs_ids,
                'meta_key'         => 'docs_type',
                'meta_value'       => 'receipt',
                'fields'           => 'ids'
            );
	
            $document_ids = '';
			if(sizeof($docs_ids) > 0){
				$document_ids = get_posts($args);
			}
	
            if($document_ids){
            ?>
            <div class="d-flex justify-content-end py-3 border-bottom-1">
                <button class="btn btn-secondary reset-filter mr-2" data-type="receipt" type="submit">Reset</button>
                <div class="input-group filter">
                    <input type="date" class="form-control filter-date" id="receipts-filter" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success document_filter" data-type="receipt" type="submit">Find</button>
                    </div>
                </div>
            </div>
            <ul class="m-0 list-group list-group-flush" id="receipts-list">
                <?php
                foreach($document_ids as $doc_id){
                    $doc_file = get_post_meta( $doc_id, 'document_file', true );
                    $filename = basename ( get_attached_file( $doc_file ) );
                    $fileurl =  wp_get_attachment_url( $doc_file );
                    $publish_date = get_the_date( 'm/d/Y', $doc_id );
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="file_info d-flex flex-column">
                            <span class="filename font-weight-bold"><?php echo $filename ?></span>
                            <span class="published_date font-weight-light"><?php echo $publish_date ?></span>
                        </div>

                        <div class="file_action">
                            <a href="<?php echo esc_url($fileurl) ?>" target="_black" class="ml-3 btn btn-primary view-file-btn">View</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php }else{
                print_r("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
            } ?>
        </div>
        <div class="tab-pane fade" id="letters" role="tabpanel" aria-labelledby="letters-tab">
            <?php
            $args1 = array(
                'post_type' => 'urmdocument',
                'numberposts' => -1,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'include'          => $docs_ids,
                'meta_key'         => 'docs_type',
                'meta_value'       => 'letters',
                'fields'           => 'ids'
            );

            $letters_ids = '';
			if(sizeof($docs_ids) > 0){
				$letters_ids = get_posts($args1);
			}
            if($letters_ids){
            ?>
            <div class="d-flex justify-content-end py-3 border-bottom-1">
                <button class="btn btn-secondary reset-filter mr-2" data-type="letter" type="submit">Reset</button>
                <div class="input-group filter">
                    <input type="date" class="form-control filter-date" id="letters-filter" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success document_filter" data-type="letter" type="submit">Find</button>
                    </div>
                </div>
            </div>
            <ul class="m-0 list-group list-group-flush" id="letters-list">
                <?php
                foreach($letters_ids as $letter_id){
                    $letter_doc_file = get_post_meta( $letter_id, 'document_file', true );
                    $letter_filename = basename ( get_attached_file( $letter_doc_file ) );
                    $letter_fileurl =  wp_get_attachment_url( $letter_doc_file );
                    $letter_publish_date = get_the_date( 'm/d/Y', $letter_id );
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="file_info d-flex flex-column">
                            <span class="filename font-weight-bold"><?php echo $letter_filename ?></span>
                            <span class="published_date font-weight-light"><?php echo $letter_publish_date ?></span>
                        </div>

                        <div class="file_action">
                            <a href="<?php echo esc_url($letter_fileurl) ?>" target="_black" class="ml-3 btn btn-primary view-file-btn">View</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php }else{
               print_r("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
            } ?>
        </div>
        <div class="tab-pane fade" id="tax-documents" role="tabpanel" aria-labelledby="tax-documents-tab">
            <?php
            $args2 = array(
                'post_type' => 'urmdocument',
                'numberposts' => -1,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'include'          => $docs_ids,
                'meta_key'         => 'docs_type',
                'meta_value'       => 'tax_documents',
                'fields'           => 'ids'
            );

            $taxs_ids = '';
			if(sizeof($docs_ids) > 0){
				$taxs_ids = get_posts($args2);
			}
            if($taxs_ids){
            ?>
            <div class="d-flex justify-content-end py-3 border-bottom-1">
                <button class="btn btn-secondary reset-filter mr-2" data-type="tax" type="submit">Reset</button>
                <div class="input-group filter">
                    <input type="date" class="form-control filter-date" id="tax-documents-filter" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success document_filter" data-type="tax" type="submit">Find</button>
                    </div>
                </div>
            </div>
            <ul class="m-0 list-group list-group-flush" id="tax-documents-list">
                <?php
                foreach($taxs_ids as $tax_id){
                    $tax_doc_file = get_post_meta( $tax_id, 'document_file', true );
                    $tax_filename = basename ( get_attached_file( $tax_doc_file ) );
                    $tax_fileurl =  wp_get_attachment_url( $tax_doc_file );
                    $tax_publish_date = get_the_date( 'm/d/Y', $tax_id );
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="file_info d-flex flex-column">
                            <span class="filename font-weight-bold"><?php echo $tax_filename ?></span>
                            <span class="published_date font-weight-light"><?php echo $tax_publish_date ?></span>
                        </div>

                        <div class="file_action">
                            <a href="<?php echo esc_url($tax_fileurl) ?>" target="_black" class="ml-3 btn btn-primary view-file-btn">View</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php }else{
               print_r("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
            } ?>
        </div>
    </div>
    <?php
}

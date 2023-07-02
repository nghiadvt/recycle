<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $termPrivacys = [
            [
                'title' => 'City of Seattle Privacy Statement',
                'content' => 'Information provided via the Seattle Recycle and Garbage Mobile Application is subject to Washington Public Records Act and may be subject to disclosure to a third-party requestor. At the City of Seattle, we are committed to protecting your privacy and will ensure that any disclosures are done according to law.',
                'type' => Page::NONE,
            ],
            [
                'title' => 'Terms of Service and Privacy Policy',
                'content' => 'THE FOLLOWING TERMS AND CONDITIONS ARE APPLIED TO RECOLLECT ACCOUNTS',
                'type' => Page::NONE,
            ],
            [
                'title' => 'ACCEPTANCE OF RECOLLECT TERMS',
                'content' => 'ReCollect Systems Inc. ("ReCollect") reserves the right to update and change, from time to time,
                                these Terms and all documents incorporated by reference.',
                'type' => Page::NONE,
            ],
            [
                'title' => 'DESCRIPTION OF SERVICE',
                'content' => 'ReCollect is a calendaring and notification service provided by ReCollect Systems Inc.',
                'type' => Page::NONE,
            ],
            [
                'title' => 'RECOLLECT RESERVATION OF RIGHTS',
                'content' => 'ReCollect expressly reserves the right to
                                immediately modify, delete content from, suspend
                                Or terminate your account and refuse current or
                                future use of any ReCollect service, if ReCollect, in
                                its sole discretion believes you have: (ï) violated
                                or tried to violate the rights of others; or (ii)
                                acted inconsistently with the spirit or letter of
                                the TOS. In such event, your ReCollect account
                                may be suspended or canceled immediately in
                                our discretion, all the information and content
                                contained within it deleted permanently and you will
                                not be entitled to any refund of any of the amounts
                                youvve paid for such account. ReCollect accepts no
                                liability for information or content that is deleted.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'INDEMNITY',
                'content' => 'You agree to indemnify and hold harmless
                                ReCollect, and its subsidiaries, affiliates, officers,
                                agents, or other partners, and employees, from any
                                claim or demand, including reasonable attorneys
                                fees, made by any third party due to or arising out of
                                your use of and access to ReCollect, your violation
                                of the Terms of Service, your violation of any rights
                                of another person or entity, or your violation of any
                                applicable laws or regulations.
                                You may not use ReCollect to harass anyone. lf
                                you set up notifications with any malevolent intent
                                whatsoever, we will cancel your service. We also
                                comply with any appropriate authorities in cases of
                                harassment.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'PRIVACY',
                'content' => 'Registration Data and certain other information
                                about you are subject to our Privacy Policy.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'AGE REQUIREMENTS FOR USE OF RECOLLECT.',
                'content' => 'ReCollect is available for individuals aged 13 years
                                or older. lf you are 13 or older but under the age of
                                18, you should review these terms and conditions
                                with your parent or guardian to make sure that you
                                and your parent or guardian understand and agree
                                to these terms and conditions.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'LOCATION OF LAWSUIT:',
                'content' => 'The ReCollect Terms of Service, which apply to
                                your ReCollect account, provides that both you
                                and ReOollect agree to submit to the personal and
                                exclusive jurisdiction of the courts located within
                                the province of British Columbia, Canada.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'THIRD PARTY RIGHTS, TERMS AND POLICIES:',
                'content' => 'terms.bound-to-google-tos.',
                'type' => Page::TERMS_OF_SERVICE,
            ],
            [
                'title' => 'Privacy Policy',
                'content' => '<hr>
                <p><i>Application of this privacy policy</i></p>
                <hr>
                <p>&nbsp;When this Privacy Policy mentions it refers to<strong>
                    ReCollect &nbsp;Systems Inc</strong>.,
                    the entity that acts as the Data Processor of your information.
                    ReCollect provides mobile and web applications on behalf many local governments and commercial organizations
                    (collectively, "<strong>Our Clients</strong>").
                    This privacy policy applies to each natural person
                    ("<strong>you</strong>" or "<strong>your</strong>")
                    using our web and mobile applications (collectively, the "<strong>Services</strong>"),
                    which may have been branded under the name of one of Our Glients,
                    as well as any interactions you may have directly with ReCollect,
                    be it through reporting a problem or feedback to us or other communication.
                    This policy does not apply to interactions between you and any of Our Glients.
                    </p><hr><p><i>Information We Collect and How We use It</i></p><hr><p>&nbsp;
                    &nbsp;We collect information to provide, maintain, and improve our Services.
                    There are two categories of informaion we collect:
                    information you give to us and information we collect automatically when you use our Services.
                    By providing information to us and using our Services.
                    </p><hr><p><i>Information You Give to Us</i></p><hr><p><span style="background-color:hsl(0, 0%, 100%);color:hsl(0, 0%, 0%);
                    ">Some of our Services require you to provide information directly to us,
                    such as your street address, postal code, phone number or email address.
                    We always try to collect the minimal amount of information required in order to provide the Services you request.
                    The information we collect depends on which Services you use</span></p>
                    <hr>
                    <p><span style="background-color:hsl(0, 0%, 100%);color:hsl(0, 0%, 0%);">
                    <strong>Information Collected by the Schedule Tool</strong>:
                    In orde to provide you with accurate schedule information for your location,
                    we collect your address, including its street address number,
                    street name, and city.</span></p><hr><p><span style="background-color:hsl(0, 0%, 100%);color:hsl(0, 0%, 0%);">
                    <strong>Information Collected when you sign up for Notifications</strong>:
                    When you sign up for event notifications,
                    we collect contact information that is required to send you those notifications.
                    This may include your email address,
                    your phone number and/or your twitter username,
                    depending on the notification method(s) you select.</span></p>',
                'type' => Page::PRIVACY_POLICY,
            ]
        ];

        foreach ($termPrivacys as $termPrivacy) {
            Page::create($termPrivacy);
        }
    }
}

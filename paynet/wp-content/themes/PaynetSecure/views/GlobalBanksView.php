<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GlobalBanksView
 *
 * @author rudyard
 */
class GlobalBanksView
{
    public function GlobalBanksView()
    {
        add_shortcode( 'GlobalBanksView', array(&$this, 'RenderView' ));  
    }
    public function RenderView($atts)
    {
        $str ='<div class="global-banks-view">
            <ul>
                <li><a href="#tabs-1">N. America</a></li>
                <li><a href="#tabs-2">S. America</a></li>
                <li><a href="#tabs-3">Europe</a></li>
                <li><a href="#tabs-5">Australia</a></li>
            </ul>
            <div id="tabs-1">
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/canada.gif" alt="Canada"><br>
                    <strong>Canada </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;" border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bmo.com/home/personal/banking/everyday/online-banking/register"><img src="'.get_bloginfo('template_url').'/images/banks/canada/montreal.gif" alt="Bank of Montreal" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.cibconline.cibc.com/olbtxn/registration/RegistrationLanding.cibc"><img src="'.get_bloginfo('template_url').'/images/banks/canada/cibc.gif" alt="CIBC" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.desjardins.com/en/dcu/produits_services/comptes-services-relies/modes-acces/accesd-internet/inscrire/"><img src="'.get_bloginfo('template_url').'/images/banks/canada/desjardins.gif" alt="Desjardins" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www1.royalbank.com/cgi-bin/rbaccess/rbunxcgi%3FF6=1%26F7=IB%26F21=IB%26F22=HT%26REQUEST=IBOnlineEnrollLink%26LANGUAGE=ENGLISH%26SPAGE=onlinenav1e"><img src="'.get_bloginfo('template_url').'/images/banks/canada/royal.gif" alt="Royal Bank" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.scotiaonline.scotiabank.com/pcbanking?reqOption=SCLoginSSL&amp;action=display&amp;token=&amp;language=English"><img src="'.get_bloginfo('template_url').'/images/banks/canada/scotia.gif" alt="Scotia Bank" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.tdcanadatrust.com/ebanking/easyweb.jsp"><img src="'.get_bloginfo('template_url').'/images/banks/canada/canadatrust.gif" alt="TD Canada Trust" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bnc.ca/bnc/files/bncmisc/en/2/adhesionsbi_webinfo.html"><img src="'.get_bloginfo('template_url').'/images/banks/canada/national.gif" alt="National Bank" border="0"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.usemybank.com/cpadinfo.asp"><img src="'.get_bloginfo('template_url').'/images/banks/canada/creditunions.gif" alt="All other Banks, Trusts, and Credit Unions" border="0"></a></td>
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/usa.gif" alt="US"><br>
                    <strong>US </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.chase.com/ccp/index.jsp?pg_name=ccpmapp/shared/marketing/page/QuickPay" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/usa/chase.gif" alt="Chase US"></a></td>
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.wellsfargo.com/help/faqs/enroll_faqs" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/usa/wellsfargo.gif" alt="WellsFargo US"></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-2">
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/brazil.gif" alt="Brazil"><br>
                    <strong>Brazil </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bb.com.br/portalbb/home29,116,116,1,1,1,1.bb" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/brazil/banco.gif" alt="bancodobrasil"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.banrisul.com.br/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/brazil/banrisul.gif" alt="banrisul"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bradesco.com.br/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/brazil/bradesco.gif" alt="bradesco"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.hsbc.com.br/1/2/portal/pt/para-voce" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/brazil/hsbc.gif" alt="hsbc"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/costarica.gif" alt="Costa Rica"><br>
                    <strong>Costa Rica </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.lafise.com/blcr/Home.aspx" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/lafise.gif" alt="Banco Lafise"></a></td>
                    
                    
                    </tr><tr>
                    <td class="maincopy" align="center"><a href="http://www.bncr.fi.cr/BNCR/Default.aspx" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/nacional.gif" alt="Banco Nacional"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.popularenlinea.fi.cr/bpop" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/popular.gif" alt="Banco Popular"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bancocathay.com/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/cathay.gif" alt="Banco Cathay"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.mucap.fi.cr/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/mucap.gif" alt="Mucap"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.grupomutual.fi.cr/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/grupo.gif" alt="Grupo Mutual"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.teledolar.com/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/costarica/teledolar.gif" alt="Teledolar"></a></td>
                    
                    
                    </tr>
                    </tbody>
                </table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/mexico.gif" alt="Mexico"><br>
                    <strong>Mexico </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.banorte.com/portal/banorte.portal" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/mexico/banorte.gif" alt="Banorte México"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bancomer.com/index.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/mexico/bancomer.gif" alt="Bancomer México"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.banamex.com.mx/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/mexico/banamex.gif" alt="Banamex México"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.hsbc.com.mx/1/2/!ut/p/kcxml/04_Sj9SPykssy0xPLMnMz0vM0Y_QjzKLN443DPACSZnFG8UbuZrqR4IZgb4wMWN0IYN4R4RIkH5BbmhoRLmjIgC_a30j" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/mexico/hsbc.gif" alt="HSBC México"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.santander.com/csgs/Satellite?pagename=SANCorporativo/GSDistribuidora/SC_Index" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/mexico/santander.gif" alt="Santander México"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/peru.gif" alt="Peru"><br>
                    <strong>Peru </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.viabcp.com/zona_publica/01_persona/index.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/peru/credito.gif" alt="BancoDeCredito"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.bbvabancocontinental.com/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/peru/continental.gif" alt="bbvacontinental"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.cmactacna.com.pe/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/peru/tacna.gif" alt="cajatacna"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.interbank.com.pe/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/peru/interbank.gif" alt="Interbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.scotiabank.com.pe/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/peru/scotiabank.gif" alt="Scotiabank"></a></td>
                    
                    
                    </tr>
                </tbody></table>
            </div>
            <div id="tabs-3">
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/austria.gif" alt="Austria"><br>
                    <strong>Austria </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://eps.raiffeisen.at/html/german/help/anmeldung.jsp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/raiffeisen.gif" alt="Raifeissen - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.volksbank.at/m101/volksbank/de/individuelle_seite/agb/agb.jsp?locincl=/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/volksbank.gif" alt="Volksbanken Gruppe - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.noehypo.at/htdocs/nav.html?Kontakt%20und%20Service+Rechtliche%20Hinweise+Bedingungen%20e-Banking&amp;lang=de" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/hypo.gif" alt="NO HYPO - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.hypovbg.at/019/hypo_hp.nsf/ibanking?OpenAgent&amp;Login0&amp;LANG=DE" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/hypo_landesbank.gif" alt="Voralberger HYPO - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.spaengler.co.at/011/ebanking_hilfe.nsf" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/bankhaus.gif" alt="Bankhaus Spangler - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.hypotirol.com/de/hypo_online/hypo_online_banking_at/wege_zur_anmeldung.shtml?lang=de" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/hypo_tirol.gif" alt="Hypo Tirol Bank - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.sparkasse.at/casserver/login?service=https%3A%2F%2Fwww.sparkasse.at%2FsPortal%2FvalidLogin.jsp&amp;layout=netbanking&amp;lang=de&amp;codPortal=SP&amp;backToSportalUrl=https%3A%2F%2Fwww.sparkasse.at%3A443%2FsPortal%2Fsportal.portal%3Fdesk%3Dsparkasseat_de_0009%26newPreviewSession%3Dtrue%26w_webc_url%3DChannels%2FE-Banking%2FStrukturcontents%2Fpk_eps_ueberweisung_pg_Content.akp%26menu_isContentInMaster%3DTRUE%26menu_isContentInMaster%3DTRUE&amp;channel=NB&amp;desk=sparkasseat_de_0009&amp;loginType=0&amp;logoUrl=/sPortal/sparkasseat_de_0009_ACTIVE/logo.gif&amp;referer=&amp;cookieEnabled=true&amp;javaon=true&amp;checked=true&amp;java=on&amp;javacheckdone=true&amp;t=0.3486687900004692&amp;status=3&amp;nblocale=de#" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/erste.gif" alt="Erste Bank und Sparkassen - Austria"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.billingpartner.com/consumer-function.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/austria/billing.gif" alt="Billing Partners"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/belgium.gif" alt="Belgium"><br>
                    <strong>Belgium</strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.payment-network.com/deb_com_en/customerarea/supported_banks" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/belgium/sofort.gif" alt="sofortüberweisung.de"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>                
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/bosnia.gif" alt="BosniaandHerzegovina"><br>
                    <strong>Bosnia and Herzegovina </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.raiffeisenbank.ba/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/bosnia/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/bulgaria.gif" alt="bulgaria"><br>
                    <strong>Bulgaria </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://rbb.bg/bg-BG/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/bulgaria/pan.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicreditbulbank.bg/bg/index.htm" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/bulgaria/unicredit.gif" alt="Unicredit Bulbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.alphabank.bg/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/bulgaria/alpha.gif" alt="Alphabank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.procreditbank-kos.com/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/bulgaria/procredit.gif" alt="ProCreditBank"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/croatia.gif" alt="Croatia"><br>
                    <strong>Croatia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.erstebank.hr/hr/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/croatia/erste.gif" alt="Erste"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.zaba.hr/home/wps/wcm/connect/zaba_hr/zabautils/naslovnica/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/croatia/zagrebacka.gif" alt="Zagrebacka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.rba.hr/my/bank/home.jsp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/croatia/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/czech.gif" alt="Czech Republic"><br>
                    <strong>Czech Republic </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.csas.cz/banka/appmanager/portal/banka?_nfpb=true&amp;_pageLabel=subportal01" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/ceska.gif" alt="Ceska"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.kb.cz/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/kb.gif" alt="KB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.rb.cz/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.csob.cz/cz/Stranky/default.aspx" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/csob.gif" alt="CSOB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.volksbank.cz/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/volksbank.gif" alt="Volksbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.gemoney.cz/ge/cz/1" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/ge.gif" alt="GEmoney"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicreditbank.cz/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/unicredit.gif" alt="UniCredit"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.fiobanka.sk/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/czech/fio.gif" alt="Fiobanka"></a></td>
                    
                    
                    </tr>
                    <tr>
                </tr></tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr><td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/estonia.gif" alt="Estonia"><br>
                    <strong>Estonia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.seb.ee/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/estonia/seb.gif" alt="SEB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.nordea.ee/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/estonia/nordea.gif" alt="Nordea"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.sampopank.ee/et/index.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/estonia/sampo.gif" alt="SampoPank"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/france.gif" alt="France"><br>
                    <strong>France </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.payment-network.com/deb_com_en/customerarea/supported_banks" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/france/sofort.gif" alt="sofortüberweisung.de"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/germany.gif" alt="Germany"><br>
                    <strong>Germany </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.payment-network.com/deb_com_en/customerarea/supported_banks" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/germany/sofort.gif" alt="sofortüberweisung.de"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.billingpartner.com/consumer-function.html" target="_blank"> <img src="'.get_bloginfo('template_url').'/images/banks/germany/billing.gif" alt="Billing Partners"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/hungary.gif" alt="Hungary"><br>
                    <strong>Hungary </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.erstebank.hu/hu/Fooldal" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/hungary/erste.gif" alt="ERSTE"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.raiffeisen.hu/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/hungary/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.otpbank.hu/portal/hu/fooldal" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/hungary/otp.gif" alt="Otpbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.kh.hu/publish/kh/hu/lakossag.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/hungary/kh.gif" alt="K&amp;H"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/italy.gif" alt="Italy"><br>
                    <strong>Italy </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.payment-network.com/deb_com_en/customerarea/supported_banks" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/italy/sofort.gif" alt="sofortüberweisung.de"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/latvia.gif" alt="Latvia"><br>
                    <strong>Latvia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.seb.lv/lv/private/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/latvia/seb.gif" alt="SEB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.nordea.lv/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/latvia/nordea.gif" alt="Nordea"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/lithuania.gif" alt="Lithuania"><br>
                    <strong>Lithuania </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.seb.lt/pow/wcp/seblt.asp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/lithuania/seb.gif" alt="SEB"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/netherlands.gif" alt="the Netherlands"><br>
                    <strong>the Netherlands </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.abnamro.nl/nl/prive/betalen/ideal/introductie.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/netherlands/abn.gif" alt="ABN AMRO - Netherlands"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.fortisbank.nl/bankzaken/cmcontent/showPage.do?page_id=ideal" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/netherlands/fortis.gif" alt="Fortis - Netherlands"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://mijn.ing.nl/internetbankieren/SesamLoginServlet" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/netherlands/ing.gif" alt="ING - Netherlands"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.rabobank.nl/particulieren/producten/betalen/betalen_via_internet/ideal" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/netherlands/rabobank.gif" alt="Rabobank - Netherlands"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.snsbank.nl/particulier/klantenservice/veelgestelde-vragen-over-klantenservice.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/netherlands/sns.gif" alt="SNS Bank - Netherlands"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/poland.gif" alt="Poland"><br>
                    <strong>Poland </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://aliorbank.pl/hades/do/Pbl" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/alior.gif" alt="Alior Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://bosbank24.pl/twojekonto" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/bos.gif" alt="BOS Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.bph.pl/pi/do/LangSelect" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/bph.gif" alt="BPH Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.db.com/poland/index.htm?dbsiteshome=_navmeta_polish" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/deutsche.gif" alt="Deutsche Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.ing.com/group/showdoc.jsp?htmlid=432311_NL&amp;menopt=abo&amp;lang=nl" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/ing.gif" alt="ING Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://secure.inteligo.com.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/inteligo.gif" alt="Inteligo Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.investbank.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/invest.gif" alt="Invest Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.kb24.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/kredyt.gif" alt="Kredyt Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.lukasbank.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/lukas.gif" alt="Lukas Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.millenet.pl/?lang=PL" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/millennium.gif" alt="Millennium Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.mbank.com.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/mbank.gif" alt="Mtransfer Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.multibank.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/multibank.gif" alt="Multi Transfer Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.nordeasolo.pl/solo/www?lang=pl&amp;indiv=yes" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/nordea.gif" alt="Nordea Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.pekao24.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/pekao.gif" alt="Pekao24 Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.ipko.pl/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/polski.gif" alt="PKO Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.centrum24.pl/bzwbkonline/eSmart.html?typ=13&amp;lang=pl" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/wbk.gif" alt="Przelew24 Bank - Poland"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.r-bank.pl/cib/do/login" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/poland/raiffeisen.gif" alt="Raiffeisen Bank - Poland"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/romania.gif" alt="Romania"><br>
                    <strong>Romania </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicredit-tiriac.ro/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/romania/unicredit.gif" alt="Unicredit Tiriac"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.volksbank.ro/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/romania/volksbank.gif" alt="Volksbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.leumi.ro/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/romania/leumi.gif" alt="Leumi"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/serbia.gif" alt="Serbia"><br>
                    <strong>Serbia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.raiffeisenbank.rs/code/navigate.aspx?Id=1" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/serbia/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicreditbank.rs/?jez=EN" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/serbia/unicredit.gif" alt="Unicredit"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/slovakia.gif" alt="Slovakia"><br>
                    <strong>Slovakia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.tatrabanka.sk/cms/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/tatra.gif" alt="Tatra Banka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.slsp.sk/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/slovenska.gif" alt="Slovenska Sporitelna"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.vub.sk/osobne-financie/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/vub.gif" alt="Vub Banka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://ib24.csob.sk/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/csob.gif" alt="CSOB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicreditbank.sk/page/en.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/unicredit.gif" alt="UniCreditBank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.volksbank.sk/servlet/vbsk?MT=/Apps/WEB/main.nsf/vw_ByID/ID_167D3C1D97E803E5C12575080046AA6B_SK&amp;OpenDocument=Y&amp;LANG=SK" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/volksbank.gif" alt="Volksbank"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.otpbank.sk/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/otp.gif" alt="otpbanka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.postovabanka.sk/sk/titulna-stranka" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/postova.gif" alt="PostovaBanka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.primabanka.sk/pre-ludi" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/prima.gif" alt="PrimaBanka"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.mbank.sk/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovakia/mbank.gif" alt="MBank"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/slovenia.gif" alt="Slovenia"><br>
                    <strong>Slovenia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.unicreditbank.si/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovenia/unicredit.gif" alt="Unicredit"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.skb.si/osebne-finance" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovenia/skb.gif" alt="SKB"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.raiffeisen.si/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/slovenia/raiffeisen.gif" alt="Raiffeisen"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/spain.gif" alt="Spain"><br>
                    <strong>Spain </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.caja3.es/paginas/paginafinal.asp?idNodo=2" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/spain/caja.gif" alt="Caja3"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.ibercaja.es/index_p.php" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/spain/iber.gif" alt="ibercaja"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/sweden.gif" alt="Sweden"><br>
                    <strong>Sweden</strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.nordea.se/Privat/Internet+och+telefon/Råd+om+Internet+och+telefon/Säkerhet/912892.html?WT.mc_id=197" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/sweden/nordea.gif" alt="Nordea"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.seb.se/pow/default.asp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/sweden/seb.gif" alt="SEB Sweden"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/switzerland.gif" alt="Switzerland"><br>
                    <strong>Switzerland </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www.payment-network.com/deb_com_en/customerarea/supported_banks" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/switzerland/sofort.gif" alt="sofortüberweisung.de"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.billingpartner.com/consumer-function.html" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/switzerland/billing.gif" alt="Billing Partners"></a></td>
                    
                    
                    </tr>
                </tbody></table>
                <br/>
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/uk.gif" alt="UK"><br>
                    <strong>UK </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.hsbc.co.uk/1/2/personal/internet-banking" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/uk/hsbc.gif" alt="HSBC UK"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.natwest.com/personal02.asp?id=PERSONAL/DAY_TO_DAY/ONLINE_BANKING&amp;referrer=globaltop" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/uk/natwest.gif" alt="NatWest UK"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.rbs.co.uk/Personal_Finances/Bank_Online/Benefits_&amp;_Features/default.htm?referrer=hmp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/uk/royalscotland.gif" alt="Royal Bank of Scotland UK"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.firstdirect.com/internetbanking/internet_banking.shtml" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/uk/firstdirect.gif" alt="First Direct UK"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.santander.co.uk/csgs/Satellite?appID=abbey.internet.Abbeycom&amp;c=Page&amp;canal=CABBEYCOM&amp;cid=1210610636150&amp;empr=Abbeycom&amp;leng=en_GB&amp;pagename=Abbeycom%2FPage%2FWC_ACOM_TemplateC2" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/uk/santander.gif" alt="Santander UK"></a></td>
                    
                    
                    </tr>
                </tbody></table>
            </div>
            <div id="tabs-5">
                <table align="center">
                    <tbody><tr>
                    <td class="maincopy" colspan="2" align="center"><img src="'.get_bloginfo('template_url').'/images/banks/countries/australia.gif" alt="Australia"><br>
                    <strong>Australia </strong></td>
                    </tr>
                </tbody></table>
                <table style="width: 250px; margin: 0 auto;"  border="1" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                    <td class="login" align="center"><strong>Online Bank</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.anz.com/personal/ways-bank/internet-banking/" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/australia/anz.jpg" alt="ANZ Bank - Australia"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="https://www1.my.commbank.com.au/netbank/Registration/mixed/SelectCard.aspx" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/australia/commonwealth.gif" alt="CommonWealth Bank - Australia"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.nab.com.au/wps/wcm/connect/nab/nab/home/Personal_Finance/12/2/?ncID=ZBA" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/australia/nab.gif" alt="National Australia Bank - Australia"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.stgeorge.com.au/accounts/ways-you-can-bank/internet-banking/get-started.asp" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/australia/stgeorge.gif" alt="St.George Bank - Australia"></a></td>
                    
                    
                    </tr>
                    <tr>
                    <td class="maincopy" align="center"><a href="http://www.westpac.com.au/internet/publish.nsf/Content/PB+Westpac+Online" target="_blank"><img src="'.get_bloginfo('template_url').'/images/banks/australia/westpac.gif" alt="WestPac bank - Australia"></a></td>
                    
                    
                    </tr>
                </tbody></table>
            </div>
        </div>
        <script type="text/javascript">
            jQuery("div.global-banks-view").tabs(); 
        </script>';        
        return $str;
    }
    
}
$view = new GlobalBanksView();
?>

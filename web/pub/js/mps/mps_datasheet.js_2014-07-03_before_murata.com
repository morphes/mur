function LinkSelect(form, sel)
{
//	c = sel.selectedIndex;
//	adrs ="http://www.murata-ps.com/data/"+sel.options[c].value;
	selval = form.sel.options[form.sel.selectedIndex].value;
	testings = /\/data\/ads/;
	
	if(selval != "none")
	{
		if(selval == "/en/application-notes.html" || selval =="/en/products/obsolete-and-not-recommended.html")
		{
//			adrs2 ="http://www.murata-ps.com"+selval;
			adrs2 =selval;
			location.href=adrs2;
		}
		else if(testings.test(selval))
		{
			adrs ="http://www.datel.com/data_sheets/?http://www.datel.com"+selval;
			location.href=adrs;
		}
		else
		{
			adrs ="http://www.murata-ps.com/datasheet?http://www.murata-ps.com"+selval;
			location.href=adrs;
		}
	}
	else
	{
		alert("please select a datasheet");
	}
}


{
document.write('<table>');
document.write('<form name="datasheet">');
document.write('<tr>');
document.write('<td>');
document.write('<SELECT NAME="sel" SIZE="" onChange="LinkSelect(this.form, sel);"> ');
document.write('<OPTION value=none class=selectgray>Download a Data Sheet (PDF)</OPTION>');
document.write('<OPTION value=none>------------</OPTION>');
document.write('<OPTION value="/en/application-notes.html" class="bold">View APPLICATION NOTES</OPTION>');
document.write('<OPTION value=none>------------</OPTION>');
document.write('<OPTION value="/en/products/obsolete-and-not-recommended.html" class="selectyellow bold">View NOT RECOMMENDED</OPTION>');
document.write('<OPTION value="/en/products/obsolete-and-not-recommended.html" class="selectred bold">View OBSOLETE</OPTION>');
document.write('<OPTION value=none>------------</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_1000.pdf">1000</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_1100r.pdf">1100R</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1200r.pdf">1200RS</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1200lr.pdf">1200LRS</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1300r.pdf">1300R</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1400.pdf">1400</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1500.pdf">1500</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1600.pdf">1600</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_1605.pdf">1605</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_1700.pdf">1700</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1800.pdf">1800</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_1800r.pdf">1800R</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_1900r.pdf">1900R</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_2200r.pdf">2200R</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2200rm.pdf">2200RM</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2300.pdf">2300</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_2400.pdf">2400</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2600.pdf">2600</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2700.pdf">2700</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2700t.pdf">2700T</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_2800.pdf">2800</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_2900.pdf">2900</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_2900l.pdf">2900L</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3000a.pdf">3000A</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3000b.pdf">3000B</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3200.pdf">3200</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3300.pdf">3300</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3400.pdf">3400</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3400l.pdf">3400L</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3500.pdf">3500</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3600.pdf">3600</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3700.pdf">3700</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3800.pdf">3800</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_3900.pdf">3900</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4000.pdf">4000</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_4100.pdf">4100</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4200.pdf">4200</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4300.pdf">4300</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4500.pdf">4500</OPTION>');  
document.write('<OPTION value="/data/magnetics/kmp_4600.pdf">4600</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4700.pdf">4700</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_4700s.pdf">4700S</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_4800.pdf">4800</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_4800s.pdf">4800S</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_4900.pdf">4900</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_4900s.pdf">4900S</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5000c.pdf">5000</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5100.pdf">5100</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5200.pdf">5200</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5300c.pdf">5300</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5400c.pdf">5400</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5500c.pdf">5500</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_5600.pdf">5600</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_6000a.pdf">6000A</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_6000b.pdf">6000B</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_7625xen.pdf">76250EN/76253EN</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_766.pdf">766</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_772.pdf">772</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_782482.pdf">782482</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_782485c.pdf">782485</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_78250.pdf">78250</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_78250j.pdf">78250J</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_78253.pdf">78253</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_78253j.pdf">78253J</OPTION>'); 
document.write('<OPTION value="/data/magnetics/kmp_786.pdf">786</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_786j.pdf">786J</OPTION>');
document.write('<OPTION value="/data/meters/mpm_78sr-2a_a00.pdf">78SR, 2A</OPTION>');
document.write('<OPTION value="/data/meters/dms-78xxsr.pdf">78xxSR</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_803.pdf">803</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_8200c.pdf">8200</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_8300.pdf">8300</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_8400.pdf">8400</OPTION>');
document.write('<OPTION value="/data/meters/aca20pc.pdf">ACA-20PC</OPTION>');
document.write('<OPTION value="/data/meters/aca20rm.pdf">ACA-20RM</OPTION>');
document.write('<OPTION value="/data/meters/aca20rm-alm.pdf">ACA-20RM-ALM</OPTION>');
document.write('<OPTION value="/data/meters/aca520pc.pdf">ACA5-20PC</OPTION>');
document.write('<OPTION value="/data/meters/aca5-20rm.pdf">ACA5-20RM</OPTION>');
document.write('<OPTION value="/data/meters/acm20.pdf">ACM20</OPTION>');
document.write('<OPTION value="/data/meters/acm3p.pdf">ACM3P</OPTION>');
document.write('<OPTION value="/data/power/bwr15-20wa-series.pdf">A-Series, BWR, 15-20W</OPTION>');
document.write('<OPTION value="/data/power/bwr7-10wa-series.pdf">A-Series, BWR, 7-10W</OPTION>');
document.write('<OPTION value="/data/power/twr12-15w.pdf">A-Series, TWR, 12-15W</OPTION>'); 
document.write('<OPTION value="/data/power/twr20wa-series.pdf">A-Series, TWR, 20W</OPTION>');
document.write('<OPTION value="/data/power/twr8-11w.pdf">A-Series, TWR, 8-11W</OPTION>');
document.write('<OPTION value="/data/power/uwr14-20wa-series.pdf">A-Series, UWR, 14-20W</OPTION>');
document.write('<OPTION value="/data/power/uwr26-40w.pdf">A-Series, UWR, 26-40W</OPTION>');
document.write('<OPTION value="/data/power/uwr6-10wa-series.pdf">A-Series, UWR, 6-10W</OPTION>');
document.write('<OPTION value="/data/power/uwr15wa-series.pdf">A-Series, UWR, 7-15W</OPTION>');
document.write('<OPTION value="/data/power/bei15.pdf">BEI15</OPTION>');
document.write('<OPTION value="/data/power/bwr33w.pdf">BWR-5/3.3, 33W</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_c1u-w-1200-12-tx.pdf">C1U-W-1200-12-Tx</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_c1u-w-1200-48-tx.pdf">C1U-W-1200-48-Tx</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_cme.pdf">CME</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_cmr.pdf">CMR</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/tps_cpci200d.pdf">cPCI200D</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cpci325d-10xc_series.pdf">cPCI325D-10xC</OPTION>'); 
document.write('<OPTION value="/data/acdcsupplies/d1u2-d-400-12-ha4c.pdf">D1U2-D-400-12-HA4C</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u2-w-400-12-ha4c.pdf">D1U2-W-400-12-HA4C</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u3cs-d-850-12-hxxc.pdf">D1U3CS-D-850-12-HxxC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u3cs-w-850-12-hxxc.pdf">D1U3CS-W-850-12-HxxC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u3cs-w-1200-12-hxxc.pdf">D1U3CS-W-1200-HxxC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u4-w-1200-hx.pdf">D1U4-W-1200-12</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u4-w-1600-hx.pdf">D1U4-W-1600-12</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u4cs-d-2100-54-hxxdc.pdf">D1U4CS-D-2100-5x-HA3DC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u4cs-w-2200-12.pdf">D1U4CS-W-2200-12-HxxC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u5cs-h-2825-12-ha4c.pdf">D1U5CS-H-2825-12-HA4C</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u54p-w-1200-12-hxxc.pdf">D1U54P-W-1200-12-HxxC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/d1u86g-w-460-12-hxx.pdf">D1U86G-W-460-12-HxxDC</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-h-2800-52-hbxc.pdf">D1U-H-2800-52</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-w-1200.pdf">D1U-W-1200-12</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-1200-48-hx.pdf">D1U-W-1200-48</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-w-1600.pdf">D1U-W-1600-12</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-1600-48-hx.pdf">D1U-W-1600-48</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_d1u-2000-48-hx.pdf">D1U-W-2000-48</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_da100.pdf">DA100</OPTION>');
document.write('<OPTION value="/data/magnetics/kmp_da100j.pdf">DA100J</OPTION>');
document.write('<OPTION value="/data/power/dbq.pdf">DBQ, DVQ</OPTION>');
document.write('<OPTION value="/data/meters/dca20pc.pdf">DCA-20PC</OPTION>');
document.write('<OPTION value="/data/meters/dca520pc.pdf">DCA5-20PC</OPTION>');
document.write('<OPTION value="/data/meters/dmr20-1-acv.pdf">DMR20-1-ACV</OPTION>');
document.write('<OPTION value="/data/meters/dmr20-10-dcm.pdf">DMR20-10-DCM</OPTION>');
document.write('<OPTION value="/data/meters/dms-20acv.pdf">DMS-20ACV</OPTION>');
document.write('<OPTION value="/data/meters/20lcd.pdf">DMS-20LCD</OPTION>');
document.write('<OPTION value="/data/meters/20lcd-01-dcm.pdf">DMS-20LCD-0/1-DCM</OPTION>');
document.write('<OPTION value="/data/meters/20lcd-23-dcm.pdf">DMS-20LCD-2/3-DCM</OPTION>');
document.write('<OPTION value="/data/meters/20lcd420.pdf">DMS-20LCD-4/20</OPTION>');
document.write('<OPTION value="/data/meters/20pc.pdf">DMS-20PC</OPTION>');
document.write('<OPTION value="/data/meters/pc0-dcms.pdf">DMS-20PC-0/1/2/8-DCM</OPTION>');
document.write('<OPTION value="/data/meters/dms-05v.pdf">DMS-20PC-0/5</OPTION>');
document.write('<OPTION value="/data/meters/20pc-lm.pdf">DMS-20PC-1-LM</OPTION>');
document.write('<OPTION value="/data/meters/dms-lm2.pdf">DMS-20PC-2-LM</OPTION>');
document.write('<OPTION value="/data/meters/pc3-dcms.pdf">DMS-20PC-3-DCM</OPTION>');
document.write('<OPTION value="/data/meters/20pc_420.pdf">DMS-20PC-4/20</OPTION>');
document.write('<OPTION value="/data/meters/pc4-dcms.pdf">DMS-20PC-4/5/6-DCM</OPTION>');
document.write('<OPTION value="/data/meters/pc7-dcm.pdf">DMS-20PC-7-DCM</OPTION>');
document.write('<OPTION value="/data/meters/dms-20pc-9-dcm.pdf">DMS-20PC-9-DCM</OPTION>')
document.write('<OPTION value="/data/meters/dms20-fm.pdf">DMS-20PC-FM</OPTION>');
document.write('<OPTION value="/data/meters/dms20-cp.pdf">DMS-20 Panel Punch</OPTION>');
document.write('<OPTION value="/data/meters/20rm.pdf">DMS-20RM</OPTION>');
document.write('<OPTION value="/data/meters/dms30dr.pdf">DMS-30DR</OPTION>');
document.write('<OPTION value="/data/meters/30lcd.pdf">DMS-30LCD</OPTION>');
document.write('<OPTION value="/data/meters/30lcd420.pdf">DMS-30LCDA-4/20</OPTION>');
document.write('<OPTION value="/data/meters/30pc.pdf">DMS-30PC</OPTION>');
document.write('<OPTION value="/data/meters/30pc_420.pdf">DMS-30PC-4/20</OPTION>');
document.write('<OPTION value="/data/meters/dms30-cp.pdf">DMS-30 Panel Punch</OPTION>');
document.write('<OPTION value="/data/meters/40lcd.pdf">DMS-40LCD</OPTION>');
document.write('<OPTION value="/data/meters/40lcd420.pdf">DMS-40LCD-4/20</OPTION>');
document.write('<OPTION value="/data/meters/40pc.pdf">DMS-40PC</OPTION>');
document.write('<OPTION value="/data/meters/40pc420.pdf">DMS-40PC-4/20</OPTION>');
document.write('<OPTION value="/data/meters/bezels.pdf">DMS-Bezels</OPTION>');
document.write('<OPTION value="/data/meters/dmcontrs.pdf">DMS-Connectors</OPTION>');
document.write('<OPTION value="/data/meters/dms-eb.pdf">DMS-EB</OPTION>');
document.write('<OPTION value="/data/meters/dms-eb2.pdf">DMS-EB2</OPTION>');
document.write('<OPTION value="/data/meters/eb-acdc.pdf">DMS-EB-AC/DC</OPTION>');
document.write('<OPTION value="/data/meters/eb-dcdc.pdf">DMS-EB-DC/DC</OPTION>');
document.write('<OPTION value="/data/meters/eb-rms.pdf">DMS-EB-RMS</OPTION>');
document.write('<OPTION value="/data/meters/current_transformers.pdf">DMS-Current Transformers</OPTION>');
document.write('<OPTION value="/data/meters/dmbezels.pdf">DMS-Mounting Hardware</OPTION>');
document.write('<OPTION value="/data/meters/dpm_shunts.pdf">DMS-DC Shunts</OPTION>');
document.write('<OPTION value="/data/meters/dmu-30acv.pdf">DMU-30ACV</OPTION>');
document.write('<OPTION value="/data/meters/dmu-30dcv.pdf">DMU-30DCV</OPTION>');
document.write('<OPTION value="/data/meters/40bcd.pdf">DSD-40BCD</OPTION>');
document.write('<OPTION value="/data/power/dbq.pdf">DVQ, DBQ</OPTION>');
document.write('<OPTION value="/data/power/emh-54-3-q48n-c.pdf">EMH-54/3-Q48</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_hb01uyc.pdf">HB01UYC</OPTION>'); 
document.write('<OPTION value="/data/power/hpq_series.pdf">HPQ-3.3</OPTION>');
document.write('<OPTION value="/data/power/hpq-83.pdf">HPQ-8.3</OPTION>');
document.write('<OPTION value="/data/power/hpq-12.pdf">HPQ-12</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_ihb60tc.pdf">IHB60TC</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_lme.pdf">LME</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_lme0305sc.pdf">LME0305SC</OPTION>'); 
document.write('<OPTION value="/data/power/mapc104.pdf">MAPC-104</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mea.pdf">MEA</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mee1.pdf">MEE1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mee3.pdf">MEE3</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mef1.pdf">MEF1</OPTION>')
document.write('<OPTION value="/data/power/ncl/kdc_mej1.pdf">MEJ1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mej2.pdf">MEJ2</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mer1.pdf">MER1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_meu1.pdf">MEU1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mev.pdf">MEV1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mev3.pdf">MEV3</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mgj2.pdf">MGJ2</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mmv.pdf">MMV</OPTION>');
document.write('<OPTION value="/data/power/cps/mps_084-mps-01.pdf">MPS</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mte1.pdf">MTE1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mtu1.pdf">MTU</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_mtu2.pdf">MTU2</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/mvab120.pdf">MVAB120</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/mvac250.pdf">MVAC250</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/mvac400.pdf">MVAC400</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/mvad040.pdf">MVAD040</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/mvad065.pdf">MVAD065</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ncm6.pdf">NCM6</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ncs1.pdf">NCS1</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ncs6.pdf">NCS6</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ncs12.pdf">NCS12</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ndh.pdf">NDH</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_ndl.pdf">NDL</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nds6c.pdf">NDS6</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_ndtd.pdf">NDTD</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_ndts.pdf">NDTS</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_ndy.pdf">NDY</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_nka.pdf">NKA</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nke.pdf">NKE</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_nma.pdf">NMA</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmd.pdf">NMD</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nme.pdf">NME</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nme1515sc.pdf">NME1515SC</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nme2.pdf">NME2</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmf.pdf">NMF</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmg.pdf">NMG</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmh.pdf">NMH</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmj.pdf">NMJ</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_nmk.pdf">NMK</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nml.pdf">NML</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_nmr.pdf">NMR</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nms.pdf">NMS</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmt.pdf">NMT</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nmv.pdf">NMV</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nph10s.pdf">NPH10S</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nph15s.pdf">NPH15S</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nph25s.pdf">NPH25S</OPTION>');
document.write('<OPTION value="/data/power/ncl/kdc_nta.pdf">NTA</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nte.pdf">NTE</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_nth.pdf">NTH</OPTION>'); 
document.write('<OPTION value="/data/power/ncl/kdc_ntv.pdf">NTV</OPTION>');
document.write('<OPTION value="/data/power/oki-78sr.pdf">OKI-78SR</OPTION>');
document.write('<OPTION value="/data/power/oki-t3-w32.pdf">OKI-T/3-W32</OPTION>');
document.write('<OPTION value="/data/power/oki-t3-w40.pdf">OKI-T/3-W40</OPTION>');
document.write('<OPTION value="/data/power/oki-t36-w40.pdf">OKI-T/36W-W40</OPTION>');
document.write('<OPTION value="/data/power/okl-t1-w12.pdf">OKL-T/1-W12</OPTION>');
document.write('<OPTION value="/data/power/okl-t3-w5.pdf">OKL-T/3-W5</OPTION>');
document.write('<OPTION value="/data/power/okl-t3-w12.pdf">OKL-T/3-W12</OPTION>');
document.write('<OPTION value="/data/power/okl-t6-w5.pdf">OKL-T/6-W5</OPTION>');
document.write('<OPTION value="/data/power/okl-t6-w12.pdf">OKL-T/6-W12</OPTION>');
document.write('<OPTION value="/data/power/oklf-t25-w12.pdf">OKLF-T25-W12</OPTION>');
document.write('<OPTION value="/data/power/oklp-x25-w12.pdf">OKLP-X25-W12</OPTION>');
document.write('<OPTION value="/data/power/oklp-x35-w12.pdf">OKLP-X35-W12</OPTION>');
document.write('<OPTION value="/data/power/okl2-t12-w5.pdf">OKL2-T12-W5</OPTION>');
document.write('<OPTION value="/data/power/okl2-t12-w12.pdf">OKL2-T12-W12</OPTION>');
document.write('<OPTION value="/data/power/okl2-t20-w5.pdf">OKL2-T20-W5</OPTION>');
document.write('<OPTION value="/data/power/okl2-t20-w12.pdf">OKL2-T20-W12</OPTION>');
document.write('<OPTION value="/data/power/okr-t1-5-w12.pdf">OKR-T/1.5-W12</OPTION>');
document.write('<OPTION value="/data/power/okr-t3-w12.pdf">OKR-T/3-W12</OPTION>');
document.write('<OPTION value="/data/power/okr-t6-w12.pdf">OKR-T/6-W12</OPTION>');
document.write('<OPTION value="/data/power/okr-t10-w12.pdf">OKR-T/10-W12</OPTION>');
document.write('<OPTION value="/data/power/okx-t3-d12.pdf">OKX-T/3-D12</OPTION>');
document.write('<OPTION value="/data/power/okx-t3-w5.pdf">OKX-T/3-W5</OPTION>');
document.write('<OPTION value="/data/power/okx-t5-d12.pdf">OKX-T/5-D12</OPTION>');
document.write('<OPTION value="/data/power/okx-t5-w5.pdf">OKX-T/5-W5</OPTION>');
document.write('<OPTION value="/data/power/okx-t10-t16-d12.pdf">OKX-T/10, T/16-D12</OPTION>');
document.write('<OPTION value="/data/power/okx-t10-t16-w5.pdf">OKX-T/10, T/16-W5</OPTION>');
document.write('<OPTION value="/data/power/oky-t3-t5-d12.pdf">OKY-T/3, T/5-D12</OPTION>');
document.write('<OPTION value="/data/power/oky-t3-t5-w5.pdf">OKY-T/3, T/5-W5</OPTION>');
document.write('<OPTION value="/data/power/oky-t10-t16-d12.pdf">OKY-T/10, T/16-D12</OPTION>');
document.write('<OPTION value="/data/power/oky-t10-t16-w5.pdf">OKY-T/10, T/16-W5</OPTION>');
document.write('<OPTION value="/data/power/pae.pdf">PAE</OPTION>');
document.write('<OPTION value="/data/power/pah-28-350.pdf">PAH-28Vout 350W</OPTION>');
document.write('<OPTION value="/data/power/pah-28-450.pdf">PAH-28Vout 450W</OPTION>');
document.write('<OPTION value="/data/power/pah-53-450.pdf">PAH-48Vout 450W</OPTION>');
document.write('<OPTION value="/data/power/pah-53-450.pdf">PAH-53Vout 450W</OPTION>');
document.write('<OPTION value="/data/power/paq.pdf">PAQ</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_pwr13xx.pdf">PWR13XXC</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_pwr15xx.pdf">PWR1546AC</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_pwr1726a.pdf">PWR1726A</OPTION>');
document.write('<OPTION value="/data/power/ncl/tdc_pwr70c.pdf">PWR70C</OPTION>');
document.write('<OPTION value="/data/power/rbc17series.pdf">RBC 17</OPTION>');
document.write('<OPTION value="/data/power/rbe-12-20-d48.pdf">RBE-12/20-D48</OPTION>');
document.write('<OPTION value="/data/power/rbq-12-33-d48.pdf">RBQ-12/33-D48</OPTION>');
document.write('<OPTION value="/data/power/ncl/mdc_ruw15.pdf">RUW15</OPTION>');
document.write('<OPTION value="/data/acdcsupplies/cps_s1u-3x.pdf">S1U-3X</OPTION>');
document.write('<OPTION value="/data/power/cps/odc_sbst.pdf">SBST</OPTION>');
document.write('<OPTION value="/data/power/spm15.pdf">SPM15</OPTION>');
document.write('<OPTION value="/data/power/spm25.pdf">SPM25</OPTION>');
<!--document.write('<OPTION value="/data/power/ucr100.pdf">UCR100</OPTION>');-->
document.write('<OPTION value="/data/power/udq.pdf">UDQ</OPTION>');
document.write('<OPTION value="/data/power/uee.pdf">UEE</OPTION>');
document.write('<OPTION value="/data/power/uee150w.pdf">UEE150W</OPTION>');
document.write('<OPTION value="/data/power/mdc_uei-50-60w.pdf">UEI 50-60W</OPTION>');
document.write('<OPTION value="/data/power/mdc_uei-15w.pdf">UEI15</OPTION>');
document.write('<OPTION value="/data/power/mdc_uei-25.pdf">UEI25</OPTION>');
document.write('<OPTION value="/data/power/mdc_uei-30w.pdf">UEI30</OPTION>');
document.write('<OPTION value="/data/power/uhe12-30w.pdf">UHE, 12-30W</OPTION>');
document.write('<OPTION value="/data/power/ule20a.pdf">ULE</OPTION>');
document.write('<OPTION value="/data/power/uls-30w.pdf">ULS-30W</OPTION>');
document.write('<OPTION value="/data/power/uls.pdf">ULS-60W</OPTION>');
document.write('<OPTION value="/data/power/uls-100.pdf">ULS-100W</OPTION>');
document.write('<OPTION value="/data/power/ult.pdf">ULT</OPTION>');
document.write('<OPTION value="/data/power/uqq7-15a.pdf">UQQ, 7-15A</OPTION>');
document.write('<OPTION value="/data/power/uvq_series.pdf">UVQ</OPTION>');
document.write('<OPTION value="/data/power/uwe-100-120.pdf">UWE-100-120W</OPTION>');
document.write('<OPTION value="/data/power/uwe.pdf">UWE</OPTION>');
document.write('<OPTION value="/data/power/uwq.pdf">UWQ-12/17-Q48</OPTION>');
document.write('<OPTION value="/data/power/uwq-t.pdf">UWQ-12/17-Q48T</OPTION>');
document.write('<OPTION value="/data/power/uwq-12-20-t48.pdf">UWQ-12/20-T48</OPTION>');
document.write('<OPTION value="/data/power/uwr96_100.pdf">UWR-96/100-D48A</OPTION>');
document.write('<OPTION value="/data/power/uws.pdf">UWS</OPTION>');
document.write('<OPTION value="/data/power/cps/odc_vr110.pdf">VR110</OPTION>'); 
document.write('<OPTION value="/data/power/cps/odc_vr11c.pdf">VR11C</OPTION>'); 
document.write('<OPTION value="/data/power/cps/odc_vr11c.pdf">VR11E</OPTION>'); 
document.write('<OPTION value=none class=selectgray>Select a Technical Article</OPTION>');
document.write('<OPTION value="/data/articles/selecting_non-isolated_pols.pdf">Non-isolated POLs</OPTION>');
document.write('</select>');
document.write('</td>');
document.write('</tr>');
document.write('</form>');
document.write('</table>');
}
function IsValidURL(myPointer) {
		return (myPointer > 0  &&  myPointer < 12);
	}

function stockcheckR()
{
	if (IsValidURL(document.URL.indexOf("stkcheck.com")))
	{
		stocksearch.method = 'get';
	}
}
setTimeout(stockcheckR,500);

function getArgs(variable)
{
	var query = window.location.search.substring(1); 
	var vars = query.split("&"); 
	for (var i=0;i<vars.length;i++) { 
		var pair = vars[i].split("="); 
		if (pair[0] == variable) { 
			return pair[1]; 
		} 
	} 
	return; 
} 
 


function StockCheckTitle()
{
	if (IsValidURL(document.URL.indexOf("stkcheck.com")))
	{
		if (document.title == "Murata Power Solutions")
		{
			var args = getArgs("part");
			if (!args)
			{
				args = "Search";
			}
			document.title = args +" | Search inventory / Where to buy | Murata Power Solutions";
		}
	}
}
StockCheckTitle();


<!-- Begin
function replaceChars(entry) {
	out = "("; // replace this
	add = "["; // with this
			
	out2 = ")"; // replace this
	add2 = "]"; // with this
	
	out3 = "\""; // replace this
	add3 = "''"; // with this
	
	out4 = "~"; // replace this
	add4 = "-"; // with this
	
	out5 = "\\"; // replace this
	add5 = "/"; // with this
	
	out5 = "having"; // replace this
	add5 = "haVing"; // with this
	
	out6 = "="; // replace this
	add6 = "eq."; // with this
	
	temp = "" + entry; // temporary holder
	while (temp.indexOf(out)>-1) {
		pos= temp.indexOf(out);
		temp = "" + (temp.substring(0, pos) + add + 
		temp.substring((pos + out.length), temp.length));
	}
	while (temp.indexOf(out2)>-1) {
		pos= temp.indexOf(out2);
		temp = "" + (temp.substring(0, pos) + add2 + 
		temp.substring((pos + out.length), temp.length));
	}
	while (temp.indexOf(out3)>-1) {
		pos= temp.indexOf(out3);
		temp = "" + (temp.substring(0, pos) + add3 + 
		temp.substring((pos + out.length), temp.length));
	}
	while (temp.indexOf(out4)>-1) {
		pos= temp.indexOf(out4);
		temp = "" + (temp.substring(0, pos) + add4 + 
		temp.substring((pos + out.length), temp.length));
	}
	while (temp.indexOf(out5)>-1) {
		pos= temp.indexOf(out5);
		temp = "" + (temp.substring(0, pos) + add5 + 
		temp.substring((pos + out.length), temp.length));
	}
	while (temp.indexOf(out6)>-1) {
		pos= temp.indexOf(out6);
		temp = "" + (temp.substring(0, pos) + add6 + 
		temp.substring((pos + out.length), temp.length));
	}
	document.getElementById('comment').value = temp;
}
//  End -->

#
# Table structure for table 'tx_formvouchers'
#
CREATE TABLE tx_formvouchers (
    uid int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
    pid int(11) DEFAULT 0 NOT NULL,

    voucher varchar(25) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT 0 NOT NULL,
    crdate int(11) unsigned DEFAULT 0 NOT NULL,
    deleted tinyint(4) unsigned DEFAULT 0 NOT NULL,
    hidden tinyint(4) unsigned DEFAULT 0 NOT NULL,
    

    PRIMARY KEY (uid),
    KEY parent (pid),
);

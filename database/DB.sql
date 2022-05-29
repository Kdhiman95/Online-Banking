create table 'user' (
	accountNo INT PRIMARY KEY DEFAULT 1,
	firstName VARCHAR(20)
);
INSERT INTO 'user' (`accountNo`, `firstName`) VALUES ('12000508','Kamal'),
('12000509','Umang'),
('12000504','ffhf'),
('12000556','Ksmal');
ALTER TABLE user
MODIFY `accountNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12000557;

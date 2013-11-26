create database itb;
use itb;

create table mahasiswa (
	nim_mahasiswa varchar(8) NOT NULL,
	nama_mahasiswa varchar(20) NOT NULL,
	alamat_mahasiswa varchar(20) NOT NULL,
	tgl_lahir_mahasiswa date NOT NULL,
	primary key (nim_mahasiswa));
	
create table mata_kuliah (
	kode_mk varchar(6) NOT NULL,
	nama_mk varchar(20) NOT NULL,
	jumlah_sks int NOT NULL,
	primary key (kode_mk));
	
create table ambil_mk (
	nim_mahasiswa varchar(8) NOT NULL,
	kode_mk varchar(6) NOT NULL,
	nilai varchar(1) NOT NULL,
	foreign key (nim_mahasiswa) references mahasiswa (nim_mahasiswa),
	foreign key (kode_mk) references mata_kuliah (kode_mk));
	
insert into mahasiswa (nim_mahasiswa, nama_mahasiswa, alamat_mahasiswa, tgl_lahir_mahasiswa) values
('18211001', 'Danny', 'Jl.Ciumbuleuit', '1993-12-02'), ('18211002', 'Hendy', 'Jl.Tubis', '1993-05-03'),
('18211003', 'Anthony', 'Jl.Ahmad Yani', '1993-02-01'), ('18211004', 'Loekito', 'Jl.Siliwangi', '1990-02-10'),
('18211005', 'David', 'Jl.Cisitu', '1992-01-20'), ('18211006', 'Derrick', 'Jl.Sempurna', '1985-02-10'),
('18211007', 'Cyntia', 'Jl.Pekalongan', '1989-07-15'), ('18211008', 'Betty', 'Jl.Cempaka', '1991-04-05'),
('18211009', 'Budi', 'Jl.Jemadi', '1995-02-13'), ('18211010', 'Vincent', 'Jl.Melati', '1985-09-11');
	
insert into mata_kuliah (kode_mk, nama_mk, jumlah_sks) values
('II2210', 'Jaringan Komputer', '3'), ('II2211', 'Layanan STI', '3'),
('II2212', 'Manajemen Proyek', '3'), ('II2213', 'Analisis Kebutuhan Enterprise', '3'),
('II2214', 'Sistem Multimedia', '3'), ('II2215', 'Basis Data', '3'),
('II2216', 'OOP', '3'), ('II2217', 'Orkom', '3');

insert into ambil_mk (nim_mahasiswa, kode_mk, nilai) values
('18211001', 'II2214', 'A'), ('18211001', 'II2216', 'B'),
('18211001', 'II2217', 'C'), ('18211001', 'II2211', 'A'),
('18211002', 'II2213', 'A'), ('18211002', 'II2214', 'B'),
('18211002', 'II2215', 'C'), ('18211002', 'II2216', 'A'),
('18211003', 'II2212', 'A'), ('18211003', 'II2213', 'B'),
('18211003', 'II2214', 'C'), ('18211003', 'II2215', 'A'),
('18211004', 'II2211', 'A'), ('18211004', 'II2212', 'B'),
('18211004', 'II2213', 'C'), ('18211004', 'II2214', 'A'),
('18211005', 'II2215', 'A'), ('18211005', 'II2216', 'B'),
('18211006', 'II2217', 'C'), ('18211006', 'II2211', 'A'),
('18211007', 'II2212', 'A'), ('18211007', 'II2213', 'B'),
('18211008', 'II2214', 'C'), ('18211009', 'II2215', 'A');



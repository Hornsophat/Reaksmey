<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProductNames($term, $limit = 5)
    {
        $this->db->select('id, code, name')
            ->like('name', $term, 'both')->or_like('code', $term, 'both');
        $this->db->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStaff()
    {
        if ($this->Admin) {
            $this->db->where('group_id !=', 1);
        }
        $this->db->where('group_id !=', 3)->where('group_id !=', 4);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
     public function getAllPurchases($first_date = '', $last_date = '', $categories = '')
    {
        $where = "";
        if ($categories != '' && $categories != NULL) {
            $where .= "AND p.category_id = '$categories'";
        }
        return $this->db->query("
            SELECT
            pu.*, SUM(pi.subtotal) AS total_amount, c.name AS supplier_name
            FROM
            sma_purchases pu
            LEFT JOIN sma_purchase_items pi ON pu.id = pi.purchase_id
            INNER JOIN sma_products p ON pi.product_id = p.id 
            LEFT JOIN sma_companies c ON pu.supplier_id = c.id 
            WHERE
            pu.payment_status = 'paid'
            AND date( pu.`date` ) >= '$first_date' 
            AND date( pu.`date` ) <= '$last_date' 
            {$where}
            GROUP BY
            c.id
        ")->result();
    }
     public function getAllTotalDue($first_date = '', $last_date = '')
    {
        return $this->db->query("
            SELECT SUM(amount) AS due
            FROM sma_payments
            WHERE
            note = 'from list sale payment'
            AND DATE( `date` ) >= '$first_date' 
            AND DATE( `date` ) <= '$last_date' 
        ")->row()->due;
    }
    public function getAllTotalPaid($first_date = '', $last_date = '')
    {
        return $this->db->query("
            SELECT SUM(amount) AS paid
            FROM sma_payments
            WHERE
            type = 'received'
            AND DATE( `date` ) >= '$first_date' 
            AND DATE( `date` ) <= '$last_date' 
        ")->row()->paid;
    }
    public function getAllTotalDelivery($first_date, $last_date)
    {
        $where = "";
        if ($first_date != '' && $last_date != '') {
            $where .= "AND DATE(`date`) >= '$first_date' AND DATE(`date`) <= '$last_date'";
        }
       return $this->db->query("
            SELECT SUM(shipping) AS delivery
            FROM sma_sales
            WHERE sale_status = 'completed' {$where}"
        )->row()->delivery;
    }
    // ===================================add report model=====================
    function get_expanse($date,$first_date,$last_date){
        if($first_date!='' && $last_date!=''){
            $this->db->where('date>=',$first_date);
            $this->db->where('date<=',$last_date);
            $this->db->where('status =','expend');
        }else{
            $this->db->where('date_format(date,"%Y-%m-%d")',$date);
        }
        return $this->db->get('purchases')->result();
    }
    public function getAllSuppliers()
    {
        $this->db->where('group_name','supplier');
        $q = $this->db->get('companies');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    public function getSuppliersrow($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('companies');
        if ($q->num_rows() > 0) {
            // foreach (($q->result()) as $row) {
                // $data[] = $row;
            // }
            return $q->row();
        }
        return FALSE;
    }
    function get_mypurchase($supplier,$date,$first_date,$last_date){
        if($first_date!='' && $last_date!=''){
            $this->db->where('date>=',$first_date);

            $this->db->where('date<=',$last_date);

            $this->db->where('status <>','expend');
        }else{
            $this->db->where('date_format(date,"%Y-%m-%d")',$date);
        }
        if($supplier!=''){
            $this->db->where('supplier_id',$supplier);
            $this->db->where('status <>','expend');
        }
        return $this->db->get('purchases')->result();
    }
    function get_mysale($supplier,$date,$first_date,$last_date){
        if($first_date!='' && $last_date!=''){
            $this->db->where('date>=',$first_date);

            $this->db->where('date<=',$last_date);
        }else{
            $this->db->where('date_format(date,"%Y-%m-%d")',$date);
        }
        if($supplier!=''){
            $this->db->where('customer_id',$supplier);
        }
        return $this->db->get('sales')->result();
    }
    public function getAllCustomers()
    {
        $this->db->where('group_name','customer');
        $q = $this->db->get('companies');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    function sh_customrp($fdate, $ldate, $category=''){
        $date=date('Y-m-d');
        $where = " AND DATE_FORMAT(se.date,'%Y-%m-%d')='$date'";
        if($fdate !='' && $ldate !=''){
            $where = " AND se.date BETWEEN '$fdate' AND '$ldate'";
        }
        if($category != '') {
            $where_cat = " AND c.name = '$category'";
        } else { 
            $where_cat = ''; 
        }
        $sql = "SELECT s.*,c.name as name, SUM(s.quantity)as total_qty,SUM(s.subtotal)as sale_price ,p.cost as tcost,SUM(s.item_discount) as pdis,se.total_discount as discount,SUM(s.item_invoice_dis) as tidis,s.real_unit_price
                FROM sma_sale_items s
                LEFT JOIN sma_products p
                ON p.id = s.product_id
                LEFT JOIN sma_categories c
                ON c.id = p.category_id
                LEFT JOIN sma_sales se
                ON se.id = s.sale_id
                WHERE 1=1 {$where} {$where_cat}
                GROUP BY s.product_id";
        return $this->db->query($sql)->result();
    }
    function get_warehouse()
    {
        return $this->db->query("SELECT * FROM sma_warehouses ")->result();
    }
    public function getAllCategories() {
        $this->db->order_by('name');
        $q = $this->db->get('categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        // return FALSE;
    }
    function cs_customrp($category=''){
        $this->db->select('wp.quantity as quantity, pr.code as product_code, pr.name as product_name, pr.cost as product_cost, pr.price as product_price, pr.alert_quantity as alert, ca.name as category_name');
        $this->db->from('warehouses_products wp');
        $this->db->join('products pr', 'wp.product_id=pr.id');
        $this->db->join('categories ca', 'pr.category_id=ca.id');
        $this->db->where('pr.type =','standard');


        if($category != '') {
            $this->db->where('ca.name', $category);
        }
        // $this->db->where('pr.used_stock', 1);

        $this->db->group_by('wp.product_id');
        $query = $this->db->get();
        return $query->result();

        // $sql="SELECT * 
        //         FROM warehouses_products wp
        //         INNER JOIN products pr ON wp.product_id = pr.id
        //         WHERE 1=1 {$where_cat}
        //         GROUP BY product_id";
        // echo $sql; die();
        // return $this->db->query($sql)->result();
    }
    // ====================================end add model==========================

    public function getSalesTotals($customer_id)
    {

        $this->db->select('SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid', FALSE)
            ->where('customer_id', $customer_id);
        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getCustomerSales($customer_id)
    {
        $this->db->from('sales')->where('customer_id', $customer_id);
        return $this->db->count_all_results();
    }

    public function getCustomerQuotes($customer_id)
    {
        $this->db->from('quotes')->where('customer_id', $customer_id);
        return $this->db->count_all_results();
    }

    public function getCustomerReturns($customer_id)
    {
        $this->db->from('sales')->where('customer_id', $customer_id)->where('sale_status', 'returned');
        return $this->db->count_all_results();
    }

    public function getStockValue()
    {
        $q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select COALESCE(sum(" . $this->db->dbprefix('warehouses_products') . ".quantity), 0)*price as by_price, COALESCE(sum(" . $this->db->dbprefix('warehouses_products') . ".quantity), 0)*cost as by_cost FROM " . $this->db->dbprefix('products') . " JOIN " . $this->db->dbprefix('warehouses_products') . " ON " . $this->db->dbprefix('warehouses_products') . ".product_id=" . $this->db->dbprefix('products') . ".id GROUP BY " . $this->db->dbprefix('products') . ".id )a");
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getWarehouseStockValue($id)
    {
        $q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select sum(COALESCE(" . $this->db->dbprefix('warehouses_products') . ".quantity, 0))*price as by_price, sum(COALESCE(" . $this->db->dbprefix('warehouses_products') . ".quantity, 0))*cost as by_cost FROM " . $this->db->dbprefix('products') . " JOIN " . $this->db->dbprefix('warehouses_products') . " ON " . $this->db->dbprefix('warehouses_products') . ".product_id=" . $this->db->dbprefix('products') . ".id WHERE " . $this->db->dbprefix('warehouses_products') . ".warehouse_id = ? GROUP BY " . $this->db->dbprefix('products') . ".id )a", array($id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    // public function getmonthlyPurchases()
    // {
    //     $myQuery = "SELECT (CASE WHEN date_format( date, '%b' ) Is Null THEN 0 ELSE date_format( date, '%b' ) END) as month, SUM( COALESCE( total, 0 ) ) AS purchases FROM purchases WHERE date >= date_sub( now( ) , INTERVAL 12 MONTH ) GROUP BY date_format( date, '%b' ) ORDER BY date_format( date, '%m' ) ASC";
    //     $q = $this->db->query($myQuery);
    //     if ($q->num_rows() > 0) {
    //         foreach (($q->result()) as $row) {
    //             $data[] = $row;
    //         }
    //         return $data;
    //     }
    //     return FALSE;
    // }

    public function getChartData()
    {
        $myQuery = "SELECT S.month,
        COALESCE(S.sales, 0) as sales,
        COALESCE( P.purchases, 0 ) as purchases,
        COALESCE(S.tax1, 0) as tax1,
        COALESCE(S.tax2, 0) as tax2,
        COALESCE( P.ptax, 0 ) as ptax
        FROM (  SELECT  date_format(date, '%Y-%m') Month,
                SUM(total) Sales,
                SUM(product_tax) tax1,
                SUM(order_tax) tax2
                FROM " . $this->db->dbprefix('sales') . "
                WHERE date >= date_sub( now( ) , INTERVAL 12 MONTH )
                GROUP BY date_format(date, '%Y-%m')) S
            LEFT JOIN ( SELECT  date_format(date, '%Y-%m') Month,
                        SUM(product_tax) ptax,
                        SUM(order_tax) otax,
                        SUM(total) purchases
                        FROM " . $this->db->dbprefix('purchases') . "
                        GROUP BY date_format(date, '%Y-%m')) P
            ON S.Month = P.Month
            ORDER BY S.Month";
        $q = $this->db->query($myQuery);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getDailySales($year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
			FROM " . $this->db->dbprefix('sales') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
			GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getMonthlySales($year, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
			FROM " . $this->db->dbprefix('sales') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " DATE_FORMAT( date,  '%Y' ) =  '{$year}'
			GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStaffDailySales($user_id, $year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('sales')." WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " created_by = {$user_id} AND DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
            GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStaffMonthlySales($user_id, $year, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('sales') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " created_by = {$user_id} AND DATE_FORMAT( date,  '%Y' ) =  '{$year}'
            GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getPurchasesTotals($supplier_id)
    {
        $this->db->select('SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid', FALSE)
            ->where('supplier_id', $supplier_id);
        $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getSupplierPurchases($supplier_id)
    {
        $this->db->from('purchases')->where('supplier_id', $supplier_id);
        return $this->db->count_all_results();
    }

    public function getStaffPurchases($user_id)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid', FALSE)
            ->where('created_by', $user_id);
        $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getStaffSales($user_id)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid', FALSE)
            ->where('created_by', $user_id);
        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalSales($start, $end, $warehouse_id = NULL)
    {
        $this->db->select('count(id) as total, sum(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid, SUM(COALESCE(total_tax, 0)) as tax', FALSE)
            ->where('sale_status !=', 'pending')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalPurchases($start, $end, $warehouse_id = NULL)
    {
        $this->db->select('count(id) as total, sum(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid, SUM(COALESCE(total_tax, 0)) as tax', FALSE)
            ->where('status !=', 'pending')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalExpenses($start, $end, $warehouse_id = NULL)
    {
        $this->db->select('count(id) as total, sum(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->get('expenses');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalPaidAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'sent')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedCashAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')->where('paid_by', 'cash')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedCCAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')->where('paid_by', 'CC')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedChequeAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')->where('paid_by', 'Cheque')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedPPPAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')->where('paid_by', 'ppp')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReceivedStripeAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'received')->where('paid_by', 'stripe')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalReturnedAmount($start, $end)
    {
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where('type', 'returned')
            ->where('date BETWEEN ' . $start . ' and ' . $end);
        $q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getWarehouseTotals($warehouse_id = NULL)
    {
        $this->db->select('sum(quantity) as total_quantity, count(id) as total_items', FALSE);
        $this->db->where('quantity !=', 0);
        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->get('warehouses_products');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getCosting($date, $warehouse_id = NULL, $year = NULL, $month = NULL)
    {
        $this->db->select('SUM( COALESCE( purchase_unit_cost, 0 ) * quantity ) AS cost, SUM( COALESCE( sale_unit_price, 0 ) * quantity ) AS sales, SUM( COALESCE( purchase_net_unit_cost, 0 ) * quantity ) AS net_cost, SUM( COALESCE( sale_net_unit_price, 0 ) * quantity ) AS net_sales', FALSE);
        if ($date) {
            $this->db->where('costing.date', $date);
        } elseif ($month) {
            $this->load->helper('date');
            $last_day = days_in_month($month, $year);
            $this->db->where('costing.date >=', $year.'-'.$month.'-01 00:00:00');
            $this->db->where('costing.date <=', $year.'-'.$month.'-'.$last_day.' 23:59:59');
        }

        if ($warehouse_id) {
            $this->db->join('sales', 'sales.id=costing.sale_id')
            ->where('sales.warehouse_id', $warehouse_id);
        }

        $q = $this->db->get('costing');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getExpenses($date, $warehouse_id = NULL, $year = NULL, $month = NULL)
    {
        $sdate = $date.' 00:00:00';
        $edate = $date.' 23:59:59';
        $this->db->select('SUM( COALESCE( amount, 0 ) ) AS total', FALSE);
        if ($date) {
            $this->db->where('date >=', $sdate)->where('date <=', $edate);
        } elseif ($month) {
            $this->load->helper('date');
            $last_day = days_in_month($month, $year);
            $this->db->where('date >=', $year.'-'.$month.'-01 00:00:00');
            $this->db->where('date <=', $year.'-'.$month.'-'.$last_day.' 23:59:59');
        }
        

        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }

        $q = $this->db->get('expenses');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getReturns($date, $warehouse_id = NULL, $year = NULL, $month = NULL)
    {
        $sdate = $date.' 00:00:00';
        $edate = $date.' 23:59:59';
        $this->db->select('SUM( COALESCE( grand_total, 0 ) ) AS total', FALSE)
        ->where('sale_status', 'returned');
        if ($date) {
            $this->db->where('date >=', $sdate)->where('date <=', $edate);
        } elseif ($month) {
            $this->load->helper('date');
            $last_day = days_in_month($month, $year);
            $this->db->where('date >=', $year.'-'.$month.'-01 00:00:00');
            $this->db->where('date <=', $year.'-'.$month.'-'.$last_day.' 23:59:59');
        }

        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }

        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getOrderDiscount($date, $warehouse_id = NULL, $year = NULL, $month = NULL)
    {
        $sdate = $date.' 00:00:00';
        $edate = $date.' 23:59:59';
        $this->db->select('SUM( COALESCE( order_discount, 0 ) ) AS order_discount', FALSE);
        if ($date) {
            $this->db->where('date >=', $sdate)->where('date <=', $edate);
        } elseif ($month) {
            $this->load->helper('date');
            $last_day = days_in_month($month, $year);
            $this->db->where('date >=', $year.'-'.$month.'-01 00:00:00');
            $this->db->where('date <=', $year.'-'.$month.'-'.$last_day.' 23:59:59');
        }

        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }

        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getExpenseCategories()
    {
        $q = $this->db->get('expense_categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getDailyPurchases($year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('purchases') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
            GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getMonthlyPurchases($year, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('purchases') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " DATE_FORMAT( date,  '%Y' ) =  '{$year}'
            GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStaffDailyPurchases($user_id, $year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('purchases')." WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " created_by = {$user_id} AND DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
            GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStaffMonthlyPurchases($user_id, $year, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('purchases') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " created_by = {$user_id} AND DATE_FORMAT( date,  '%Y' ) =  '{$year}'
            GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getBestSeller($start_date, $end_date, $warehouse_id = NULL)
    {
        $this->db
            ->select("product_name, product_code")->select_sum('quantity')
            ->join('sales', 'sales.id = sale_items.sale_id', 'left')
            ->where('date >=', $start_date)->where('date <=', $end_date)
            ->group_by('product_name, product_code')->order_by('sum(quantity)', 'desc')->limit(10);
        if ($warehouse_id) {
            $this->db->where('sale_items.warehouse_id', $warehouse_id);
        }
        $q = $this->db->get('sale_items');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    function getPOSSetting()
    {
        $q = $this->db->get('pos_settings');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

        function get_report_inventory($whid, $datef, $datet, $cate, $scate)
    {
        $where = '';
        $wheres = '';
        if($whid != ''){
            $where = " AND warehouse_id='$whid'";
        }
        if($cate != ''){
            $wheres = " AND p.category_id='$cate'";
        }
        if($scate != ''){
            $wheres = " AND p.subcategory_id='$scate'";
        }

        $q = "SELECT *
            FROM (SELECT p.`code`, p.id, p.`name`, po.total_po, s.total_sale, p.price, c.`name` AS cate_name
                FROM sma_products p
                LEFT JOIN sma_categories c ON p.category_id = c.id
                LEFT JOIN (SELECT SUM(quantity_received) AS total_po, product_id
                    FROM sma_purchase_items
                    WHERE date(`date`) >= '$datef' AND date(`date`) <= '$datet' {$where}
                    GROUP BY product_id
                ) AS po ON p.id = po.product_id
                LEFT JOIN (SELECT SUM(quantity) AS total_sale, product_id
                    FROM sma_sale_items 
                    WHERE warehouse_id = '1' 
                    GROUP BY product_id 
                ) AS s ON p.id = s.product_id WHERE 1 = 1 {$wheres}) AS T
        WHERE total_po IS NOT NULL";
        // $re=$this->db->query($q)->result();
        // var_dump($re);die();

        return $this->db->query($q)->result();
    }
    function  get_cus_payment_report(){
        $this->db->select('*');
        $this->db->from('sma_companies');
        $this->db->where('group_name','customer');
        $resu=$this->db->get()->result();
        return $resu;
    }
    function get_all_supp_payment_report(){
        $this->db->select('*');
        $this->db->from('sma_companies');
        $this->db->where('group_name','supplier');
        $re_supp=$this->db->get()->result();
        return $re_supp;
    }

    function get_account_report($cus_re_id,$datef,$datet){
        $where='';
        if ($cus_re_id !='') {
             $where_cus= "AND   `customer_id` = '$cus_re_id' ";
        }else{
            $where_cus ='';
        }
        $res="SELECT * , sum(s.grand_total) as gtotal, sum(s.paid) as paid_total,c.company,c.address,c.phone,c.email
        from sma_sales s
        LEFT JOIN sma_companies c ON s.customer_id = c.id
        WHERE date(`date`) >= '$datef' AND date(`date`) <= '$datet' {$where_cus} AND group_name='customer'
        GROUP BY c.id ";

        // $s=$this->db->query($res)->result();
        // var_dump($s);die();
        return $this->db->query($res)->result();
    }

    function get_account_payable_report($supp_id,$fd,$td){
        $where='';
        if ($where_supp !='') {
           $where_supp="AND supplier_id = $supp_id";
        }else{
            $where_supp = '';
        }
        $p_re="SELECT *,sum(p.grand_total) as gptotal,sum(p.paid) as gppaid,c.address,c.company,c.`name`,c.phone,c.email
                FROM sma_purchases p
                LEFT JOIN sma_companies c ON p.supplier_id= c.id
                WHERE date(`date`) >= '$fd' AND date(`date`) <= '$td' {$where_supp} AND group_name='supplier'
                GROUP BY c.id ";

        // $re=$this->db->query($p_re)->result();
        // var_dump($re);die();

        return $this->db->query($p_re)->result();
    }

// $supp_det_id,$fd_det,$td_det

    function get_all_detail_account_receivable_report($redet_cus_id){
        $det="SELECT * , sum(s.grand_total) as gtotal, sum(s.paid) as paid_total,s.total,
                s.customer_id,c.company,c.address,c.phone,c.email,si.quantity,si.unit_price,si.product_unit_code,si.product_name,si.unit_price
        from sma_sales s
        LEFT JOIN sma_companies c ON s.customer_id = c.id
                LEFT JOIN sma_sale_items si ON s.id = si.sale_id
        WHERE s.customer_id=$redet_cus_id AND group_name='customer'
                AND payment_status <> 'paid'
                AND paid < grand_total
                GROUP BY s.id";

        return $this->db->query($det)->result();
    }

    function get_invoice_detail_report($inv_sale_id){
        $inv_det="SELECT * , sum(s.grand_total) as gtotal, sum(s.paid) as paid_total,
                s.customer_id,c.company,c.address,c.phone,c.email,si.quantity,si.unit_price,si.product_unit_code
                from sma_sales s
                LEFT JOIN sma_companies c ON s.customer_id = c.id
                        LEFT JOIN sma_sale_items si ON s.id  = si.sale_id
                WHERE si.sale_id = '$inv_sale_id'
                        AND group_name='customer'
                        AND payment_status <> 'paid'
                        GROUP BY si.id";
        return $this->db->query($inv_det)->result();
    }

    function get_all_list_account_receivable($supp_re_det_id){
        $re_det="SELECT *,sum(sp.grand_total) as pgtotal,sum(sp.paid) as pptotal ,spi.product_name,spi.quantity,sc.company,sc.phone,sc.address
            FROM sma_purchases sp
            LEFT JOIN sma_purchase_items spi
            ON spi.purchase_id = sp.id
            LEFT JOIN sma_companies sc
            ON sc.id = sp.supplier_id
            WHERE supplier_id = $supp_re_det_id
            GROUP BY sp.id";

        return $this->db->query($re_det)->result();
    }

    function get_print_payment_invoice_detail($paydet){
        $pay_det="SELECT *, sp.id, spi.product_name,spi.quantity,sc.company,sc.phone,sc.address
            FROM sma_purchases sp
            LEFT JOIN sma_purchase_items spi
            ON spi.purchase_id = sp.id
            LEFT JOIN sma_companies sc
            ON sc.id = sp.supplier_id
            WHERE sp.id = $paydet
            AND payment_status <> 'paid'
            GROUP BY spi.id ";

        return $this->db->query($pay_det)->result();
    }
    function search_customer_buy($fdate,$ldate,$customer_id='',$product_from='',$warehouse_id,$pto)
    {   
        $where='';
        if($customer_id!=''){
            $where.= " and s.customer_id='$customer_id'";
        }
        if($product_from!=''){
            $where.= " and si.product_code='$product_from'";
        }
        // if ($warehouse_id != '') {
        //     $where.="and wp.warehouse_id = '$warehouse_id'";
        // }
        return $this->db->query("SELECT s.customer,s.customer_id,si.product_id,si.product_code,si.product_name,p.`code`,p.unit, SUM(si.quantity) as total_qty,SUM(subtotal) as total_amount
                                FROM 
                                sma_sales s
                                INNER JOIN
                                    sma_sale_items si 
                                ON s.id=si.sale_id
                                 LEFT JOIN
                                    sma_products p 
                                ON p.id=si.product_id
                                LEFT JOIN sma_companies c
                                ON c.id = s.customer_id
                                WHERE DATE_FORMAT(s.date,'%Y-%m-%d')>=DATE_FORMAT('$fdate','%Y-%m-%d') AND DATE_FORMAT(s.date,'%Y-%m-%d')<=DATE_FORMAT('$ldate','%Y-%m-%d') AND c.group_name = 'customer' {$where}
                                GROUP BY s.customer_id,si.product_id order by customer_id ASC")->result();
    }
    function GetAllpurchaseItems($fdate, $ldate, $category=''){
        $date=date('Y-m-d');
        $where = "  DATE_FORMAT(p.date,'%Y-%m-%d')='$date'";
        if($fdate !='' && $ldate !=''){
            $where = "p.date BETWEEN '$fdate' AND '$ldate'";
        }
        if($category != '') {
            $where_cat = "AND pr.category_id = '$category'";
        } else { 
            $where_cat = ''; 
        }
        $sql = "SELECT pi.*, SUM(pi.quantity_received) as purchased,SUM(subtotal) as subtotalpurchase,c.name as name
                from sma_purchase_items pi
                LEFT JOIN sma_purchases p
                ON pi.purchase_id=p.id
                LEFT JOIN sma_products pr 
                ON pi.product_id=pr.id
                LEFT JOIN sma_categories c
                ON pr.category_id=c.id
                WHERE {$where} {$where_cat}
                GROUP BY pi.product_id
                ";
        return $this->db->query($sql)->result();
    }

}

package com.domain;

import javax.persistence.*;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

@Entity
@Table(name = "tax")
public class Tax {
    @NotNull(message = "Select a category")
    @Column(name = "category")
    private String category;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    //@Size(min = 5, max = 20, message = "The Name '${validatedValue}' must be between {min} and {max} characters long")
    //@NotNull(message = "Input the name")
    @Column(name = "username")
    private String username;
    //    @NotNull(message = "Input the user id")
//    @Column(name = "user_id")
//    private Long user_id;
    @Min(value = 1000, message = "Minimum Salary is {value}")
    @NotNull(message = "Input the salary")
    @Column(name = "basic_salary")
    private double basic_salary;
    @Column(name = "basic_salary_exemption")
    private double basic_salary_exemption;
    @Column(name = "basic_salary_taxable")
    private double basic_salary_taxable;

    @NotNull(message = "Input the houserent")
    @Column(name = "houserent")
    private double houserent;
    @Column(name = "houserent_exemption")
    private double houserent_exemption;
    @Column(name = "houserent_taxable")
    private double houserent_taxable;

    @NotNull(message = "Input medical allowance")
    @Column(name = "medical")
    private double medical;
    @Column(name = "medical_exemption")
    private double medical_exemption;
    @Column(name = "medical_taxable")
    private double medical_taxable;
    @NotNull
    @Column(name = "conveyance")
    private double conveyance;
    @Column(name = "conveyance_exemption")
    private double conveyance_exemption;
    @Column(name = "conveyance_taxable")
    private double conveyance_taxable;
    @NotNull
    @Column(name = "commission")
    private double commission;
    @Column(name = "commission_exemption")
    private double commission_exemption;
    @Column(name = "commission_taxable")
    private double commission_taxable;
    @NotNull
    @Column(name = "bonus")
    private double bonus;
    @Column(name = "bonus_exemption")
    private double bonus_exemption;
    @Column(name = "bonus_taxable")
    private double bonus_taxable;
    @Column(name = "totalIncome")
    private double totalIncome;
    @Column(name = "totalTaxable")
    private double totalTaxable;
    @Column(name = "grossTax")
    private double grossTax;

    public String getCategory() {
        return category;
    }

    public void setCategory(String category_select) {
        this.category = category_select;
    }

    public double getBasic_salary() {
        return basic_salary;
    }

    public void setBasic_salary(double basic_salary) {
        this.basic_salary = basic_salary;
    }

    public double getHouserent() {
        return houserent;
    }

    public void setHouserent(double houserent) {
        this.houserent = houserent;
    }

    public double getMedical() {
        return medical;
    }

    public void setMedical(double medical) {
        this.medical = medical;
    }

    public double getConveyance() {
        return conveyance;
    }

    public void setConveyance(double conveyance) {
        this.conveyance = conveyance;
    }

    public double getCommission() {
        return commission;
    }

    public void setCommission(double commission) {
        this.commission = commission;
    }

    public double getBonus() {
        return bonus;
    }

    public void setBonus(double bonus) {
        this.bonus = bonus;
    }

    public double getBasic_salary_exemption() {
        return basic_salary_exemption;
    }

    public void setBasic_salary_exemption(double basic_salary_exemption) {
        this.basic_salary_exemption = basic_salary_exemption;
    }

    public double getBasic_salary_taxable() {
        return basic_salary_taxable;
    }

    public void setBasic_salary_taxable(double basic_salary_taxable) {
        this.basic_salary_taxable = basic_salary_taxable;
    }

    public double getHouserent_exemption() {
        return houserent_exemption;
    }

    public void setHouserent_exemption(double houserent_exemption) {
        this.houserent_exemption = houserent_exemption;
    }

    public double getHouserent_taxable() {
        return houserent_taxable;
    }

    public void setHouserent_taxable(double houserent_taxable) {
        this.houserent_taxable = houserent_taxable;
    }

    public double getMedical_exemption() {
        return medical_exemption;
    }

    public void setMedical_exemption(double medical_exemption) {
        this.medical_exemption = medical_exemption;
    }

    public double getMedical_taxable() {
        return medical_taxable;
    }

    public void setMedical_taxable(double medical_taxable) {
        this.medical_taxable = medical_taxable;
    }

    public double getConveyance_exemption() {
        return conveyance_exemption;
    }

    public void setConveyance_exemption(double conveyance_exemption) {
        this.conveyance_exemption = conveyance_exemption;
    }

    public double getConveyance_taxable() {
        return conveyance_taxable;
    }

    public void setConveyance_taxable(double conveyance_taxable) {
        this.conveyance_taxable = conveyance_taxable;
    }

    public double getCommission_exemption() {
        return commission_exemption;
    }

    public void setCommission_exemption(double commission_exemption) {
        this.commission_exemption = commission_exemption;
    }

    public double getCommission_taxable() {
        return commission_taxable;
    }

    public void setCommission_taxable(double commission_taxable) {
        this.commission_taxable = commission_taxable;
    }

    public double getBonus_exemption() {
        return bonus_exemption;
    }

    public void setBonus_exemption(double bonus_exemption) {
        this.bonus_exemption = bonus_exemption;
    }

    public double getBonus_taxable() {
        return bonus_taxable;
    }

    public void setBonus_taxable(double bonus_taxable) {
        this.bonus_taxable = bonus_taxable;
    }

    public double getTotalIncome() {
        return totalIncome;
    }

    public void setTotalIncome(double totalIncome) {
        this.totalIncome = totalIncome;
    }

    public double getTotalTaxable() {
        return totalTaxable;
    }

    public void setTotalTaxable(double totalTaxable) {
        this.totalTaxable = totalTaxable;
    }

    public double getGrossTax() {
        return grossTax;
    }

    public void setGrossTax(double grossTax) {
        this.grossTax = grossTax;
    }


    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }
}

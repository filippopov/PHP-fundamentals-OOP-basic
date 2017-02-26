<?php

class Employee
{
    private $name;
    private $salary;
    private $position;
    private $department;
    private $email;
    private $age;

    public function __construct($name, $salary, $position, $department, $email, $age)
    {
        $this->setName($name);
        $this->setSalary($salary);
        $this->setPosition($position);
        $this->setDepartment($department);
        $this->setEmail($email);
        $this->setAge($age);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function __toString()
    {
        $salary = number_format($this->getSalary(), 2);
        return "{$this->getName()} {$salary} {$this->getEmail()} {$this->getAge()}";
    }
}

class EmployeeDB
{
    /** @var Employee[] $allEmployees */
    private $allEmployees = [];
    private $departments = [];

    public function setEmployees(Employee $employee)
    {
        $this->allEmployees[] = $employee;
    }

    public function getHighestAverageSalaryByDepartment()
    {
        foreach ($this->allEmployees as $employee) {
            if (! isset($this->departments[$employee->getDepartment()])) {
                $this->departments[$employee->getDepartment()] = [];
                $this->departments[$employee->getDepartment()][] = $employee;
            } else {
                $this->departments[$employee->getDepartment()][] = $employee;
            }
        }

        $sum = 0;
        $count = 0;
        $bestAverageSalary = 0;
        $bestDepartment = '';

        foreach ($this->departments as $department => $employees) {
            foreach ($employees as $tempEmployee) {
                $sum += $tempEmployee->getSalary();
                $count++;
            }

            $averageSalary = $sum / $count;

            if ($averageSalary > $bestAverageSalary) {
                $bestAverageSalary = $averageSalary;
                $bestDepartment = $department;
            }
        }

        return $bestDepartment;
    }

    public function getEmployeesByDepartment($department)
    {
        $employeeArray = $this->departments[$department];

        usort($employeeArray, function (Employee $a, Employee $b){
            return $a->getSalary() < $b->getSalary();
        });

        for ($i = 0; $i < count($employeeArray); $i++) {
            echo $employeeArray[$i];

            if ($i < (count($employeeArray) - 1)) {
                echo PHP_EOL;
            }
        }
    }
}


$counter = trim(fgets(STDIN));
$employeeDB = new EmployeeDB();

for ($i = 0; $i < $counter; $i++) {
    $employeeTest = trim(fgets(STDIN));
    $employeeArray = explode(' ', $employeeTest);
    $name = $employeeArray[0];
    $salary = $employeeArray[1];
    $position = $employeeArray[2];
    $department = $employeeArray[3];
    $email = "n/a";
    $age = -1;

    if (count($employeeArray) == 6) {
        $email = $employeeArray[4];
        $age = $employeeArray[5];
        $employee = new Employee($name, $salary, $position, $department, $email, $age);
        $employeeDB->setEmployees($employee);
    } elseif (count($employeeArray) == 4) {
        $employee = new Employee($name, $salary, $position, $department, $email, $age);
        $employeeDB->setEmployees($employee);
    } elseif (count($employeeArray) == 5) {
        $emailOrAge = $employeeArray[4];
        if (is_numeric($employeeArray[4])) {
            $age = $employeeArray[4];
        } else {
            $email = $employeeArray[4];
        }

        $employee = new Employee($name, $salary, $position, $department, $email, $age);
        $employeeDB->setEmployees($employee);
    }
}

$department = $employeeDB->getHighestAverageSalaryByDepartment();
echo "Highest Average Salary: {$department}" . PHP_EOL;
$employeeDB->getEmployeesByDepartment($department);
?>